<?php
return array(
    'title'       => __( 'Hero Banner', 'atlantic' ),
    'description' => _x( 'Full width hero section with heading and button.', 'Block pattern description', 'atlantic' ),
    'categories'   => array( 'featured', 'banner' ),
    'viewportWidth'=> 1400,
    'content'      => '<!-- wp:cover {"overlayColor":"strong-magenta","dimRatio":50,"minHeight":400,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:400px"><span aria-hidden="true" class="wp-block-cover__background has-strong-magenta-background-color has-background-dim-50 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center">Hero Title</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Add a short description or tagline here.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"very-dark-gray","textColor":"very-light-gray"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-very-light-gray-color has-very-dark-gray-background-color has-text-color has-background">Call to Action</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
);
