<?php
return array(
    'title'       => __( 'Hero Banner', 'atlantic' ),
    'description' => _x( 'A hero section with heading and call to action.', 'Block pattern description', 'atlantic' ),
    'categories'   => array( 'featured' ),
    'viewportWidth'=> 1200,
    'content'      => '<!-- wp:cover {"overlayColor":"black","minHeight":320,"contentPosition":"center center"} -->
<div class="wp-block-cover" style="min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-50"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center"} --><h2 class="has-text-align-center">Hero Headline</h2><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Intro text goes here.</p><!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"textColor":"very-light-gray","backgroundColor":"very-dark-gray"} --><div class="wp-block-button"><a class="wp-block-button__link has-very-light-gray-color has-very-dark-gray-background-color has-text-color has-background">Call to action</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div><!-- /wp:cover -->',
);
