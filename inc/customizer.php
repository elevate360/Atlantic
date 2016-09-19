<?php
/**
 * Atlantic Theme Customizer.
 *
 * @package Atlantic
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function atlantic_customize_register( $wp_customize ) {
	
	//create new controller for displaying select lists with optgroups (used for fonts)
	class WP_Customize_Control_Select_Optgroup extends WP_Customize_Control{
		
		public function render_content(){
			
			$html = '';
			
			//get choices, an array of category names and applicable fonts
			$choices = $this->choices;
			
			if($choices){
				//display the label
				if(!empty($this->label)){
					$html .= '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
				}
				//display the description
				if(!empty($this->description)){
					$html .= '<span class="description customize-control-description"> ' . esc_html($this->description) . '</span>';
				}
	
				//display main list
				$html .= '<select ' . $this->get_link() . ' id="' . $this->id . '" name="' . $this->id . '">';
				
				//create a default option 
				$html .= '<optgroup label="Default Choice">';
					$html .= '<option value="default"> No Font </option>';
				$html .= '</optgroup>';
				
				foreach($choices as $choice){
					$category_name = $choice['category-name'];
					$category_fonts = $choice['fonts'];
					
					//display fonts segemented by category
					$html .= '<optgroup label="' . $category_name .'">';
					if($category_fonts){
						foreach($category_fonts as $font){
							//determine if this value should be preselected
							if($this->value() == $font->family){
								$html .= '<option selected id="' . $this->id . '" name="' . $this->id . '" value="' . $font->family . '">' . $font->family . '</option>';
							}else{
								$html .= '<option id="' . $this->id . '" name="' . $this->id . '" value="' . $font->family . '">' . $font->family . '</option>';
							}
						}
					}
					$html .= '</optgroup>';
				}
				$html .= '</select>';
			}
			
			echo $html;
		}
	}
	
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Color options
	$wp_customize->add_section( 'atlantic_color_options',
		array(
			'title'       => __( 'Colors', 'atlantic' ),
			'priority'    => 300,
			'capability'  => 'edit_theme_options',
			'description' => __('Change color options here.', 'atlantic'), 
		) 
	);

	$wp_customize->add_setting( 'atlantic_bg_color',
		array(
			'default' => '#ffffff',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_setting( 'atlantic_heading_color',
		array(
			'default' => '#404040',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_setting( 'atlantic_navigation_color',
		array(
			'default' => '#404040',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_setting( 'atlantic_font_color',
		array(
			'default' => '#404040',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_setting( 'atlantic_link_color',
		array(
			'default' => '#404040',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'atlantic_bg_color_control',
		array(
			'label'    => __( 'Background Color', 'atlantic' ), 
			'section'  => 'atlantic_color_options',
			'settings' => 'atlantic_bg_color',
			'priority' => 10,
		) 
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'atlantic_heading_color_control',
		array(
			'label'    => __( 'Headings Color', 'atlantic' ), 
			'section'  => 'atlantic_color_options',
			'settings' => 'atlantic_heading_color',
			'priority' => 20,
		) 
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'atlantic_navigation_color_control',
		array(
			'label'    => __( 'Navigation Color', 'atlantic' ), 
			'section'  => 'atlantic_color_options',
			'settings' => 'atlantic_navigation_color',
			'priority' => 20,
		) 
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'atlantic_font_color_control',
		array(
			'label'    => __( 'Font Color', 'atlantic' ), 
			'section'  => 'atlantic_color_options',
			'settings' => 'atlantic_font_color',
			'priority' => 30,
		) 
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'atlantic_link_color_control',
		array(
			'label'    => __( 'Links Color', 'atlantic' ), 
			'section'  => 'atlantic_color_options',
			'settings' => 'atlantic_link_color',
			'priority' => 20,
		) 
	));

	// Width options
	$wp_customize->add_section( 'atlantic_width_options',
		array(
			'title'       => __( 'Widths', 'atlantic' ),
			'priority'    => 310,
			'capability'  => 'edit_theme_options',
			'description' => __('Change width options here.', 'atlantic'), 
		) 
	);

	$wp_customize->add_setting( 'atlantic_width',
		array(
			'default' => '1280',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_setting( 'atlantic_content_width',
		array(
			'default' => '640',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 
		'atlantic_width_control',
		array(
			'label'    => __( 'Website Width', 'atlantic' ), 
			'section'  => 'atlantic_width_options',
			'settings' => 'atlantic_width',
			'type' => 'number',
			'priority' => 10,
		) 
	));
	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 
		'atlantic_content_width_control',
		array(
			'label'    => __( 'Content Width', 'atlantic' ), 
			'section'  => 'atlantic_width_options',
			'settings' => 'atlantic_content_width',
			'type' => 'number',
			'priority' => 20,
		) 
	));



	//FONTS PANEL
	
	$font_categories = array();
	
	
	//collect google fonts by categies
	$google_fonts = '';
	
	
	if (get_transient('atlantic_google_fonts')){
        $google_fonts = get_transient('atlantic_google_fonts');
		
		//check for error in returned values
		if(isset($google_fonts->error)){
		 	
			$google_api = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=AIzaSyCxW8RZ-xZVyfbY-nriW_E7VimgydHa_uo';
			$font_content = wp_remote_get( $google_api, array('sslverify'   => false) );
			
		
			//if returned successfully, update transient
			if(!isset($font_content->error)){
				set_transient('atlantic_google_fonts', $font_content, WEEK_IN_SECONDS);
			}			
		}
	}
	//transient doesn't exist, fetch it
    else{
    	
        $google_api = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=AIzaSyCxW8RZ-xZVyfbY-nriW_E7VimgydHa_uo';
        $font_content = wp_remote_get( $google_api, array('sslverify'   => false) );
		

		if(!isset($font_content->error)){
			//$google_fonts = json_decode($font_content['body']);
			set_transient( 'atlantic_google_fonts', $font_content, WEEK_IN_SECONDS );
		}
	}
	
	//Add google fonts functionality if set and correct
	$google_fonts = get_transient('atlantic_google_fonts');
	
	if(!empty($google_fonts) && !isset($google_fonts->error)){
			
		//get a listing of all fonts
		$google_fonts = json_decode($google_fonts['body']);
		
		//get font categories (serif, handwriting etc)
		$font_categories = array();
		foreach($google_fonts->items as $google_font){
			if(!in_array($google_font->category, $font_categories)){
				//create a new entry with the name of the category and an empty font list (to populate later)
				$font_categories[$google_font->category] = array('category-name' => $google_font->category, 'fonts' => array());
			}
		}
		
		//go through all categories and sort fonts into associated categories
		if($font_categories){
			foreach($font_categories as $category_key => $category_value){
				$applicable_fonts = array();
				//loop through all fonts
				foreach($google_fonts->items as $google_font){
					if($google_font->category == $category_key){
						$applicable_fonts[] = $google_font;
					}
				}
				//push all applicable fonts into the correct category
				$font_categories[$category_key]['fonts'] = $applicable_fonts;
				
			}
		}	
	}
	
	
	//array of font choices mapping REM units to percentages
	$font_rem_choices = array();
	for($i = 0; $i <= 60; $i++){
		$value = $i / 10; 
		$font_rem_choices["$value"] = $value . ' Rems';
	}
	
	//array of font weights
	$font_weight_choices = array();
	for($i = 100; $i <= 900; $i+= 100){
		$font_weight_choices[$i] = $i;
	}

	
	//Main container for font related sections
	$wp_customize->add_panel( 'atlantic_font_options_panel', 
		array(
			'title'			=> __('Font Settings', 'atlantic'),
			'description'	=> __('Chnage your font settings via the controls below', 'atlantic'),
			'priority'		=> 1000,
			'capability'    => 'edit_theme_options',
		)
	); 
	//General font options section
	$wp_customize->add_section( 'atlantic_font_general_options',
		array(
			'title'       	=> __( 'General Font Settings', 'atlantic' ),
			'priority'    	=> 330,
			'capability'  	=> 'edit_theme_options',
			'description' 	=> __('Use the settings below to adjust the typography display of the site', 'atlantic'), 
			'panel'			=> 'atlantic_font_options_panel'
		) 
 	);
	//body font setting and control
	$wp_customize->add_setting( 'atlantic_font',
		array(
			'default' => '',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control_Select_Optgroup( 
		$wp_customize, 
		'atlantic_font_control',
		array(
			'label'    => __( 'Website Body Font', 'atlantic' ),
			'description' => __('Main font used throughout the site', 'atlantic'),
			'section'  => 'atlantic_font_general_options',
			'settings' => 'atlantic_font',
			'type' => 'select',
			'choices' => $font_categories,
			'priority' => 10,
		) 
	));
	//heading fonts setting and control
	$wp_customize->add_setting( 'atlantic_heading_font',
		array(
			'default' => '',
			'transport'  => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control_Select_Optgroup( 
		$wp_customize, 
		'atlantic_heading_font_control',
		array(
			'label'    		=> __( 'Heading Font', 'atlantic' ), 
			'description'	=> __('Font used for the H1 - H6 tags', 'atlantic'),
			'section'  		=> 'atlantic_font_general_options',
			'settings' 		=> 'atlantic_heading_font',
			'type' 			=> 'select',
			'choices' 		=> $font_categories,
			'priority'		 => 20,
		) 
	));

	//Add settings for base body sizing
	$wp_customize->add_setting( 'atlantic_font_base_size', 
		array(
			'default' 			=> '1',
			'type'	  			=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	//add control to select base body size	
	$wp_customize->add_control( 'atlantic_font_base_size',
		array(
			'label'				=> __('Base Font Size', 'atlantic'),
			'description'		=> __('Sets the base font size percentage for the website (100% is approx 15px)', 'atlantic'),
			'section'			=> 'atlantic_font_general_options',
			'settings'			=> 'atlantic_font_base_size',
			'type'				=> 'select',
			'choices'			=> $font_rem_choices
		)
	);
	
	
	$header_elements = array('h1' => 'H1', '.site-title' => 'Site Title', '.site-description' => 'Site Description', 'h2' => 'H2','h3' => 'H3', 'h4' => 'H4','h5' => 'H5','h6' => 'H6');
	
	foreach($header_elements as $header_key => $header_value){
			
		//Add section for this element
		$wp_customize->add_section( 'atlantic_' . $header_key . '_options',
			array(
				'title'				=> __('Header Settings', 'atlantic'),
				'priority'			=> 350,
				'capability'		=> 'edit_theme_options',
				'description'		=> 'Controls how ' . $header_value . ' headers are displayed on your site',
				'panel'				=> 'atlantic_font_options_panel'
			)
		);
		
		//Add all settiongs
		$wp_customize->add_setting( 'atlantic_' . $header_key .'_font_family', 
			array(
				'default'			=> 'default',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'postMessage',
				'sanitize_callback'	=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_setting( 'atlantic_' . $header_key .'_font_size', 
			array(
				'default'			=> '1',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'postMessage',
				'sanitize_callback'	=> 'sanitize_text_field'
			)
		);
		/*TODO: Come back here and enable the font weight settings
		$wp_customize->add_setting( 'atlantic_' . $header .'_font_weight', 
					array(
						'default'			=> '700',
						'type'				=> 'theme_mod',
						'capability'		=> 'edit_theme_options',
						'transport'			=> 'postMessage',
						'sanitize_callback'	=> 'sanitize_text_field'
					)
				);*/
		
		$wp_customize->add_setting( 'atlantic_' . $header_key .'_color',
			array(
				'default'			=> '#333',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'postMessage',
				'sanitize_callback'	=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_setting('atlantic_' . $header_key . '_margin_top', 
			array(
				'default'			=> '1',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'postMessage',
				'sanitize_callback'	=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_setting('atlantic_' . $header_key .'_margin_bottom', 
			array(
				'default'			=> '1',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'postMessage',
				'sanitize_callback'	=> 'sanitize_text_field'
			)
		);
		//Add all controls
		$wp_customize->add_control( new WP_Customize_Control_Select_Optgroup(
		$wp_customize,
		'atlantic_' . $header_key . '_font_family',
			array(
				'label'				=> __( 'Header Font Family', 'atlantic'),
				'description'		=> __('Lets you choose individual fonts for each of your header elements. If not selected will fall back to your chosen universal header font', 'atlantic'),
				'section'			=> 'atlantic_' . $header_key . '_options',
				'setting'			=> 'atlantic_' . $header_key . '_font_family',
				'type'				=> 'select',
				'choices'			=> $font_categories,
				'priority' 			=> 10,
			)
		));
		

		$wp_customize->add_control( 'atlantic_' . $header_key . '_font_size',
			array(
				'label'				=> __('Header Font Size', 'atlantic'),
				'description'		=> __('Font sizing for the header elemenets', 'atlantic'),
				'section'			=> 'atlantic_' . $header_key . '_options',
				'setting'			=> 'atlantic_' . $header_key . '_font_size',
				'type'				=> 'select',
				'choices'			=> $font_rem_choices
			)
		);
		//TODO: Come back here and enable soon
		// $wp_customize->add_control( 'atlantic_' . $header . '_font_weight',
			// array(
				// 'label'				=> __( strtoupper($header) .' Font Weight', 'atlantic'),
				// 'description'		=> __('Font weight for ' . strtoupper($header) .' elemenets. <strong>Some weights might not be applicable for your chosen font</strong>'),
				// 'section'			=> 'atlantic_' . $header . '_options',
				// 'setting'			=> 'atlantic_' . $header . '_font_size',
				// 'type'				=> 'select',
				// 'choices'			=> $font_weight_choices
			// )
		// );
	
		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'atlantic_' . $header_key . '_color',
			array(
				'label'				=> __('Header Colour', 'atlantic'),
				'description'		=> __('Text Colour for header elements', 'atlantic'),
				'section'			=> 'atlantic_' . $header_key . '_options',
				'settings'			=> 'atlantic_' . $header_key . '_color',
			)
		));
		
		
		$wp_customize->add_control( 'atlantic_' . $header_key . '_margin_top', 
			array(
				'label'				=> __('Header Margin Top Size', 'atlantic'),
				'description'		=> __('Top margin for header elements', 'atlantic'),
				'section'			=> 'atlantic_' . $header_key . '_options',
				'setting'			=> 'atlantic_' . $header_key . '_margin_top',
				'type'				=> 'select',
				'choices'			=> $font_rem_choices
			)
		);
		
		$wp_customize->add_control( 'atlantic_' . $header_key . '_margin_bottom', 
			array(
				'label'				=> __('Header Margin Bottom Size', 'atlantic'),
				'description'		=> __('Bottom margin for header elements', 'atlantic'),
				'section'			=> 'atlantic_' . $header_key . '_options',
				'setting'			=> 'atlantic_' . $header_key . '_margin_bottom',
				'type'				=> 'select',
				'choices'			=> $font_rem_choices
			)
		);
		
		
		
	}
	
	
	
	
	
	
	
	
	
}
add_action( 'customize_register', 'atlantic_customize_register' );





//Dynamic css determined by customizer
function atlantic_dynamic_css() {
	
	$header_elements = array('h1' => 'H1', '.site-title' => 'Site Title', '.site-description' => 'Site Description', 'h2' => 'H2','h3' => 'H3', 'h4' => 'H4','h5' => 'H5','h6' => 'H6');
	
?>
	<style type='text/css' class="theme-styles">
	
		<?php 
		if( get_theme_mod('atlantic_font_base_size')){?>
			
			 html{
				font-size:<?php echo get_theme_mod('atlantic_font_base_size') . 'rem'; ?>;
			}
		<?php }?>
	
		<?php if ( get_theme_mod('atlantic_bg_color') ) : ?>
			body {
				background-color:<?php echo get_theme_mod('atlantic_bg_color'); ?>;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_heading_color') ) : ?>
			h1, h2, h3, h4, h5, h6,
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
			h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
				color:<?php echo get_theme_mod('atlantic_heading_color'); ?>;
			}
		<?php endif; ?>
		
		<?php if ( get_theme_mod('atlantic_heading_font') ) : ?>
			h1, h2, h3, h4, h5, h6 {
				font-family: '<?php echo get_theme_mod('atlantic_font'); ?>', 'Courier New', Helvetica, Arial, sans-serif;
			}
		<?php endif; ?>
		
		
		<?php
		//Output dynamic H tag settings (several options per header)
		$html = '';
		foreach($header_elements as $header_key => $header_value){
			
			//font size
			$font_size = get_theme_mod('atlantic_' . $header_key . '_font_size');
			
			
			if(!empty($font_size)){
				$html .= $header_key . ' { font-size: ' . $font_size . 'rem;}'; 
			}

			//font family
			$font_family = get_theme_mod('atlantic_' . $header_key .'_font_family');
			if($font_family != 'default' && !empty($font_family)){
				$html .= $header_key . ' { font-family: ' . $font_family . '; }';
			}

			//color
			$font_color = get_theme_mod('atlantic_' . $header_key . '_color');
			if(!empty($font_color)){
				$html .= $header_key . ' { color: ' . $font_color . ';}';  
				$html .= $header_key . ' > a { color: inherit!important; }';  
			}
			
			//margin top output
			$margin_top = get_theme_mod('atlantic_' . $header_key .'_margin_top');
			if(!empty($margin_top)){
				$html .= $header_key . ' { margin-top: ' . $margin_top . 'rem;}'; 	
			}
			
			//margin bottom output
			$margin_bottom = get_theme_mod('atlantic_' . $header_key .'_margin_bottom');
			if(!empty($margin_bottom)){
				$html .= $header_key . ' { margin-bottom: ' . $margin_bottom . 'rem;}'; 	
			}
		}
		echo $html;
	
		?>
		

		<?php if ( get_theme_mod('atlantic_navigation_color') ) : ?>
			.main-navigation a,
			.main-navigation a:visited {
				color:<?php echo get_theme_mod('atlantic_navigation_color'); ?>;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_font_color') ) : ?>
			body,
			button,
			input,
			select,
			textarea {
				color:<?php echo get_theme_mod('atlantic_font_color'); ?>;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_link_color') ) : ?>
			a,
			a:visited {
				color:<?php echo get_theme_mod('atlantic_link_color'); ?>;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_width') ) : ?>
			.inner {
				max-width: <?php echo get_theme_mod('atlantic_width'); ?>px;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_content_width') ) : ?>
			.inner .inner {
				max-width: <?php echo get_theme_mod('atlantic_content_width'); ?>px;
			}
		<?php endif; ?>

		<?php if ( get_theme_mod('atlantic_font') ) : ?>
			body,
			button,
			input,
			select,
			textarea {
				font-family: '<?php echo get_theme_mod('atlantic_font'); ?>', 'Courier New', Helvetica, Arial, sans-serif;
			}
		<?php endif; ?>

		
	</style>
<?php
}
add_action( 'wp_head' , 'atlantic_dynamic_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function atlantic_customize_preview_js() {
	wp_enqueue_script( 'atlantic_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20150114', true );
}
add_action( 'customize_preview_init', 'atlantic_customize_preview_js' );
