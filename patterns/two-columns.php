<?php
return array(
    'title'       => __( 'Two Columns Text', 'atlantic' ),
    'description' => _x( 'A simple two-column layout with headings and text.', 'Block pattern description', 'atlantic' ),
    'categories'   => array( 'columns' ),
    'viewportWidth'=> 960,
    'content'      => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading --><h2>Left Heading</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Sample content in the left column.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading --><h2>Right Heading</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Sample content in the right column.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->',
);
