# Twig Tweak Extra

Custom Twig Extension for Drupal 8.

## Usage

    {# Render form. Argument is Form namespace. #}
    {{ drupal_form('Drupal\\lemonade_day_account\\Form\\RegisterAccountForm') }}

    {# Render custom block plugin. Argument is block plugin ID. #}
    {{ drupal_block_plugin('lemonade_stands_map_block') }}

    {# Render image with extra attributes. #}
    {{ render_image_with_attributes(content.field_image[0], { class:'step-image', data-animation: 'scroll-appear', width: 400, height: '600'}) }}
