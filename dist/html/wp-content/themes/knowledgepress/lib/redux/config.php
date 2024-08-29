<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
global $ss_settings;

$redux_opt_name = SHOESTRAP_OPT_NAME;

if ( !function_exists( "redux_add_metaboxes" ) ):

    function redux_add_metaboxes($metaboxes) {
      
        $headerSections[] = array(
            //'title' => __('Home Settings', 'pressapps'),
            //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'pressapps'),
            'icon' => 'el-icon-home',
            'fields' => array(  
                /*
                array(
                    'title'       => __( 'Display Custom Header.', 'knowledgepress' ),
                    'desc'        => __( 'Display custom header for this page, overrides default header settings.', 'knowledgepress' ),
                    'id'          => 'header_toggle',
                    'type'      => 'button_set',
                    'options'   => array(
                        '1' => 'Custom',
                        '0' => 'Default',
                    ),
                    'default'     => 0,
                ),
                */
                array(
                    'title'       => __( 'Header Background', 'knowledgepress' ),
                    'desc'        => __( 'Specify the background for your header.', 'knowledgepress' ),
                    'id'          => 'header_bg',
                    'output'      => '.before-main-wrapper .header-boxed, .before-main-wrapper .header-wrapper',
                    'type'        => 'background',
                //    'required'    => array( 'header_toggle','=',array( '1' ) ),
                ),
                array(
                    'title'       => __( 'Header Text Color', 'knowledgepress' ),
                    'desc'        => __( 'Select the text color for your header. Default: #333333.', 'knowledgepress' ),
                    'id'          => 'header_color',
                //    'output'      => 'body .before-main-wrapper .header-boxed, body .before-main-wrapper .header-wrapper',
                    'transparent' => false,
                    'type'        => 'color',
                //    'required'    => array('header_toggle','=',array('1')),
                ),
                array(
                    'title'     => __( 'Title & Subtitle Text Backgrounds', 'knowledgepress' ),
                    'desc'      => __( 'Adds background colors to page title and subtitle texts.', 'knowledgepress' ),
                    'id'        => 'page_title_backgrounds',
                    'type' => 'button_set',
                    'options'   => array(
                        '0' => 'Default',
                        '1' => 'On',
                        '2' => 'Off',
                    ),
                    'default'     => 0,
                ),
                array(
                    'id' => 'header_sidebar',
                    'title' => __( 'Sidebar', 'fusion-framework' ),
                    'type' => 'select',
                //    'required'    => array('header_toggle','=',array('1')),
                    'data' => 'sidebars',
                ),
                array(
                    'title'       => __( 'Header Top Padding', 'knowledgepress' ),
                    'desc'        => __( 'Select the top padding of header in pixels or set to 0 for default options panel setting.', 'knowledgepress' ),
                    'id'          => 'page_header_top_padding',
                //    'required'    => array('header_toggle','=',array('1')),
                    'default'     => 0,
                    'min'         => 0,
                    'step'        => 1,
                    'max'         => 700,
                    'type'        => 'slider'
                ),
                array(
                    'title'       => __( 'Header Bottom Padding', 'knowledgepress' ),
                    'desc'        => __( 'Select the bottom padding of header in pixels or set to 0 for default options panel setting.', 'knowledgepress' ),
                    'id'          => 'page_header_bottom_padding',
                //    'required'    => array('header_toggle','=',array('1')),
                    'default'     => 0,
                    'min'         => 0,
                    'step'        => 1,
                    'max'         => 700,
                    'type'        => 'slider'
                ),
            ),
        );


      $metaboxes = array();
      $metaboxes[] = array(
        'id' => 'demo-layout',
        'title' => __('Header Options', 'pressapps'),
        'post_types' => array('page'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'default', // high, core, default, low
        'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
        'sections' => $headerSections
      );


      $layoutSections = array();
      $layoutSections[] = array(
        //'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'title'     => __( 'Layout', 'knowledgepress' ),
                'id'        => 'page_custom_layout',
                'default'   => 'd',
                'type'      => 'select',
                'options'   => array(
                    'd'   => __( 'Default', 'knowledgepress' ),
                    'f'   => __( 'Full-Width', 'knowledgepress' ),
                    'r'   => __( 'Right Sidebar', 'knowledgepress' ),
                    'l'   => __( 'Left Sidebar', 'knowledgepress' ),
                    'll'  => __( '2 Left Sidebars', 'knowledgepress' ),
                    'rr'  => __( '2 Right Sidebars', 'knowledgepress' ),
                    'lr'  => __( '1 Left & 1 Right Sidebars', 'knowledgepress' ),
                )
            ),
            array(
                'id' => 'page_primary_sidebar',
                'title' => __( 'Primary Sidebar', 'fusion-framework' ),
                'type' => 'select',
                'required' => array('page_custom_layout', '!=', array('d', 'f')),
                'data' => 'sidebars',
            ),
            array(
                'id' => 'page_secondary_sidebar',
                'title' => __( 'Secondary Sidebar', 'fusion-framework' ),
                'type' => 'select',
                'required' => array('page_custom_layout', '!=', array('d', 'f', 'r', 'l')),
                'data' => 'sidebars',
            ),
        )
      );
      
      $metaboxes[] = array(
        'id' => 'demo-layout2',
        'title' => __('Page Options', 'pressapps'),
        'post_types' => array('page'),
        //'page_template' => array('template-knowledgebase.php', 'template-contact.php'),
        'position' => 'side', // normal, advanced, side
        'priority' => 'default', // high, core, default, low
        'sections' => $layoutSections
      );


      $subtitleSections = array();
      $subtitleSections[] = array(
        //'title' => __('Home Settings', 'pressapps'),
        //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'pressapps'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id' => 'page_header_subtitle', 
                'type' => 'text', 
                'title' => __('Subtitle', 'pressapps' ),
                'desc' => __("Enter header subtitle.", 'pressapps' ),
               // "default" => "",
            ),
        )
      );
      
      $metaboxes[] = array(
        'id' => 'demo-layout3',
        'title' => __('Header Subtitle', 'pressapps'),
        'post_types' => array('post','page'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'high', // high, core, default, low
        'sections' => $subtitleSections
      );

      $knowledgebaseTemplate = array();
      $knowledgebaseTemplate[] = array(
        //'title' => __('Home Settings', 'pressapps'),
        //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'pressapps'),
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'        => 'kb_categories',
                'type'      => 'select',
                'data'      => 'categories',
                'multi'     => true,
                'title'     => __('Categories', 'redux-framework-demo'),
                'desc'      => __('Select categories to display on Knowledge Base page template (If none selected all categories will be displayed).', 'redux-framework-demo'),
            ),
            array(
                'id' => 'kb_columns',
                'type' => 'select',
                'title' => __('Columns Per Page', 'pressapps' ), 
                'desc' => __('Select number of knowledge base columns displayed on page.', 'pressapps' ),
                'options' => array(
                    2 => '2 Columns',
                    3 => '3 Columns',
                    4 => '4 Columns',
                ),
                'default'   => '3', 
            ),
            array(
                'id' => 'kb_aticles_per_cat',
                'type' => 'select',
                'title' => __('Articles Per Category', 'pressapps' ), 
                'desc' => __('Select number of knowledge base articles displayed per category.', 'pressapps' ),
                'options' => array(
                    '3' => '3 Articles',
                    '4' => '4 Articles',
                    '5' => '5 Articles',
                    '6' => '6 Articles',
                    '7' => '7 Articles',
                    '8' => '8 Articles',
                    '10' => '10 Articles',
                    '12' => '12 Articles',
                    '14' => '14 Articles',
                    '18' => '18 Articles',
                    '20' => '20 Articles',
                    '30' => '30 Articles',
                ),
                'default'   => '7', 
            ),
            array(
                'id'        => '3rd_level_cat',
                'type'      => 'switch',
                'title'     => __('3rd level categories', 'redux-framework-demo'),
                'desc'  => __('Display 3rd level child categories.', 'redux-framework-demo'),
                'default'   => true,
            ),
        )
      );
      
      $metaboxes[] = array(
        'id' => 'kb-metabox',
        'title' => __('Knowledge Base Options', 'pressapps'),
        'post_types' => array('page'),
        'page_template' => array('template-knowledgebase.php'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'core', // high, core, default, low
        'sections' => $knowledgebaseTemplate
      );

      $contactTemplate = array();
      $contactTemplate[] = array(
        'fields' => array(
            array(
                'id'        => 'contact_email',
                'type'      => 'text',
                'title'     => __('Contact Form Email Address', 'redux-framework-demo'),
                'desc'      => __('Enter the email address where want to receive emails from the contact form or leave blank to use default admin email.', 'redux-framework-demo'),
                'validate'  => 'email',
                'default'   => '',
            ),
            array(
                'id'        => 'contact_subject',
                'type'      => 'text',
                'title'     => __('Contact Form Subject', 'redux-framework-demo'),
                'desc'      => __('Enter the subject for the contact form or leave blank to use default subject.', 'redux-framework-demo'),
                'default'   => '',
            ),
        )
      );
      
      $metaboxes[] = array(
        'id' => 'contact-metabox',
        'title' => __('Contact Form Options', 'pressapps'),
        'post_types' => array('page'),
        'page_template' => array('template-contact.php'),
        'position' => 'normal', // normal, advanced, side
        'priority' => 'core', // high, core, default, low
        'sections' => $contactTemplate
      );


      // Kind of overkill, but ahh well.  ;)
      //$metaboxes = apply_filters( 'your_custom_redux_metabox_filter_here', $metaboxes );

    return $metaboxes;
  }
  add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'redux_add_metaboxes');
endif;




// The loader will load all of the extensions automatically based on your $redux_opt_name
require_once(dirname(__FILE__).'/loader.php');