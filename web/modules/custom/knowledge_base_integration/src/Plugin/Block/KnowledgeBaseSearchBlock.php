<?php

namespace Drupal\knowledge_base_integration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides a 'KnowledgeBaseSearchBlock' block.
 *
 * @Block(
 *  id = "knowledge_base_search_block",
 *  admin_label = @Translation("Knowledge Base Search Block"),
 * )
 */
class KnowledgeBaseSearchBlock extends BlockBase {

  private function createHttpRequest($endpoint) {
    $client = \Drupal::httpClient();
    
    try {
      $request = $client->request('GET', $endpoint, [
        'headers' => [
          'Accept'     => 'application/json',
        ]
      ]);

      $status = $request->getStatusCode();

      if($status == 200) {
        $response = new Response(($request->getBody()));
        $content = json_decode($response->getContent());

        return $content;
      }
    } catch (RequestException $e) {
      \Drupal::logger('knowledge_base_integration')->notice($e);
    }
  }

  private function getLatestArticles() {
    $endpoint = \Drupal::config('knowledge_base_integration.endpoint')->get('knowledge_base');
    $results = $this->createHttpRequest($endpoint);
    $articles = $results->articles;
    $latest_articles = array_splice($articles, 0, 6);
    return $latest_articles;
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $articles = [];
    $latest_articles = $this->getLatestArticles();
    foreach($latest_articles as $article) {
      $articles[] = [
        'title' => $article->title,
        'url' => $article->html_url,
      ];
    }
    return [
      '#theme' => 'knowledge_base_search',
      '#attached' => array(
        'library' =>  array(      
          'knowledge_base_integration/libraries',
        ),
      ),
      '#articles' => $articles,
    ];
  }
}
