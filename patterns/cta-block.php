<?php
return array(
    'title'       => __( 'CTA Block', 'atlantic' ),
    'description' => _x( 'Centered call to action section with heading and button.', 'Block pattern description', 'atlantic' ),
    'categories'   => array( 'call-to-action' ),
    'viewportWidth'=> 1200,
    'content'      => '<!-- wp:group {"align":"full","backgroundColor":"very-light-gray","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}}} -->
<div class="wp-block-group alignfull has-very-light-gray-background-color has-background" style="padding-top:60px;padding-bottom:60px"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Call to Action</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Encourage visitors to take your desired action.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"strong-magenta","textColor":"very-light-gray"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-very-light-gray-color has-strong-magenta-background-color has-text-color has-background">Action Button</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
);
