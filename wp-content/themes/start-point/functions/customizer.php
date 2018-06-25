<?php
class StartPoint_Customizer {
    public static function StartPoint_Register($wp_customize) {
        self::StartPoint_Sections($wp_customize);
        self::StartPoint_Controls($wp_customize);
    }
    public static function StartPoint_Sections($wp_customize) {
        /**
         * General Section
         */
        $wp_customize->add_section('general_setting_section', array(
            'title' => __('General Settings', 'start-point'),
            'description' => __('Allows you to customize header logo, favicon, background etc settings for StartPoint Theme.', 'start-point'), //Descriptive tooltip
            'panel' => '',
            'priority' => '10',
            'capability' => 'edit_theme_options'
            )
        );
        /**
         * Home Page Top Feature Area
         */
        $wp_customize->add_section('home_top_feature_area', array(
            'title' => __('Top Feature Area', 'start-point'),
            'description' => __('Allows you to setup Top feature area section for StartPoint Theme.', 'start-point'), //Descriptive tooltip
            'panel' => '',
            'priority' => '11',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Add panel for home page feature area
         */
        $wp_customize->add_panel('home_page_feature_area_panel', array(
            'title' => __('Home Page Feature Area', 'start-point'),
            'description' => __('Allows you to setup home page feature area section for StartPoint Theme.', 'start-point'),
            'priority' => '12',
            'capability' => 'edit_theme_options'
        ));
        /**
         * Home Page feature area 1
         */
        $wp_customize->add_section('home_feature_area_section1', array(
            'title' => __('First Feature Area', 'start-point'),
            'description' => __('Allows you to setup first feature area section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page feature area 2
         */
        $wp_customize->add_section('home_feature_area_section2', array(
            'title' => __('Second Feature Area', 'start-point'),
            'description' => __('Allows you to setup second feature area section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );

        /**
         * Home Page feature area 3
         */
        $wp_customize->add_section('home_feature_area_section3', array(
            'title' => __('Third Feature Area', 'start-point'),
            'description' => __('Allows you to setup third feature area section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page Blog Headings
         */
        $wp_customize->add_section('home_page_blog_feature', array(
            'title' => __('Home Page Blog Feature Area', 'start-point'),
            'description' => __('Allows you to setup home page blog section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
                )
        );
        /**
         * Home Page Feature area setting
         */
        $wp_customize->add_section('home_page_testimonial', array(
            'title' => __('Home Page Testimonial Area', 'start-point'),
            'description' => __('Allows you to setup Home Page Testimonial Section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
             )
        );
        /**
         * Home Page Contact Section
         */
        $wp_customize->add_section('home_page_contact_feature', array(
            'title' => __('Home Page Contact Area', 'start-point'),
            'description' => __('Allows you to setup Home Page Contact Area Bottom Section for StartPoint Theme.', 'start-point'),
            'panel' => 'home_page_feature_area_panel',
            'priority' => '',
            'capability' => 'edit_theme_options'
             )
        );
        /**
         * Style Section
         */
        $wp_customize->add_section('style_section', array(
            'title' => __('Style Setting', 'start-point'),
            'description' => __('Allows you to setup Top Footer Section Text for StartPoint Theme.', 'start-point'),
            'panel' => '',
            'priority' => '13',
            'capability' => 'edit_theme_options'
                ) );

/**
         * Social Site link section
         */
        $wp_customize->add_section('social_network_section', array(
            'title' => __('Social Site links', 'dzonia-lite'),
            'description' => __('Allows you to setup social Site links for Dzonia Theme.', 'dzonia-lite'),
            'priority' => '14',
            'panel' => ''
        ));






        $wp_customize->remove_section("colors");
    }
    public static function StartPoint_Section_Content() {
        $section_content = array(
            'general_setting_section' => array(
                'startpoint_logo',
                'startpoint_headbg'
            ),
            'home_top_feature_area' => array(
                'startpoint_slideimage1',
                'startpoint_slidevideo1',
                'startpoint_sliderheading1',
                'startpoint_sliderdes1',
                'startpoint_Slider_butotntext1',
                'startpoint_Slider_buttonlink1'
            ),           
            'home_feature_area_section1' => array(
                'startpoint_threecolumn_fet_font1',
                'startpoint_threecolumn_fet_title1',
                'startpoint_services_title_link1',
                'startpoint_threecolumn_fet_desc1'
            ),
            'home_feature_area_section2' => array(
                'startpoint_threecolumn_fet_font2',
                'startpoint_threecolumn_fet_title2',
                'startpoint_services_title_link2',
                'startpoint_threecolumn_fet_desc2'
            ),
            'home_feature_area_section3' => array(
                'startpoint_threecolumn_fet_font3',
                'startpoint_threecolumn_fet_title3',
                'startpoint_services_title_link3',
                'startpoint_threecolumn_fet_desc3'
            ),
            'home_page_blog_feature' => array(
                 'startpoint_home_blog_heading',
                 'startpoint_home_blog_desc'
            ),
            'home_page_testimonial' => array(
                'startpoint_home_testimonial_heading',
                'startpoint_testimonial_image1',
                'startpoint_testimonial_text1',
                'startpoint_testimonial_name1'
            ),
            'home_page_contact_feature' => array(
                'startpoint_home_contact_heading',
                'startpoint_home_contact_desc'
            ),
             'style_section' => array(
                'startpoint_customcss'
             ),

             'social_network_section' => array(

                'inkthemes_facebook',
                'inkthemes_twitter',
                'inkthemes_google',
                'inkthemes_rss',
                'inkthemes_pinterest',
                'inkthemes_linked',
                'inkthemes_instagram',
                'inkthemes_youtube',
                'inkthemes_tumblr',
                'inkthemes_flickr'

            )

        );
        return $section_content;
    }
    public static function StartPoint_Settings() {
        $startpoint_settings = array(
            'startpoint_logo' => array(
                'id' => 'startpoint_options[startpoint_logo]',
                'label' => __('Custom Logo', 'start-point'),
                'description' => __('Upload a logo for your Website. The recommended size for the logo is 200px width x 50px height.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => ''
            ),
            'startpoint_headbg' => array(
                'id' => 'startpoint_options[startpoint_headbg]',
                'label' => __('Header Background Image', 'start-point'),
                'description' => __('Choose a suitable header background for other pages of website. For eg. page, post, etc. Optimal width is 1600px and height is 150px.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => ''
            ),     
            'startpoint_slideimage1' => array(
                'id' => 'startpoint_options[startpoint_slideimage1]',
                'label' => __('Top Feature Image', 'start-point'),
                'description' => __('The optimal size of the image is 1600 px wide x 650 px height, but it can be varied as per your requirement.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => get_template_directory_uri() . '/images/slider1.jpg'
            ),
            'startpoint_slidevideo1' => array(
                'id' => 'startpoint_options[startpoint_slidevideo1]',
                'label' => __('Top Feature Video', 'start-point'),
                'description' => __('Paste the embed code of vimeo or youtube video. Leave blank if you want a slider image.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => ''
            ),
            'startpoint_sliderheading1' => array(
                'id' => 'startpoint_options[startpoint_sliderheading1]',
                'label' => __('Top Feature Heading', 'start-point'),
                'description' => __('Mention the heading for the First slider.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Premium WordPress Themes with Single Click Installation', 'start-point')
            ),
            'startpoint_sliderdes1' => array(
                'id' => 'startpoint_options[startpoint_sliderdes1]',
                'label' => __('Top Feature Description', 'start-point'),
                'description' => __('Here mention a short description for the First slider heading.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Premium WordPress Themes with Single Click Installation, Just a Click and your website is ready for use.Premium WordPress Themes.', 'start-point')
            ),
            'startpoint_Slider_butotntext1' => array(
                'id' => 'startpoint_options[startpoint_Slider_butotntext1]',
                'label' => __('Link Text for Top Feature', 'start-point'),
                'description' => __('Mention the link text for top Feature Image', 'start-point'),
                'type' => 'option',
                'setting_type' => 'text',
                'default' => __('Read More', 'start-point')
            ),
            'startpoint_Slider_buttonlink1' => array(
                'id' => 'startpoint_options[startpoint_Slider_buttonlink1]',
                'label' => __('Link for Top Feature Image', 'start-point'),
                'description' => __('Mention button URL for first slider.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),
            // First Feature Box
            'startpoint_threecolumn_fet_font1' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_font1]',
                'label' => __('First Icon', 'start-point'),
                'description' => __('Enter the CSS class of the icons you want to use on your 3 column feature. You can find a list of icon classes To increase icon sizes relative to their container, use the fa-lg (33% increase), fa-2x, fa-3x, fa-4x, or fa-5x classes.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'text',
                'default' => 'fa fa-thumbs-up fa-5x'
            ),
            'startpoint_threecolumn_fet_title1' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_title1]',
                'label' => __('First Feature Heading', 'start-point'),
                'description' => __('Mention the heading for First Feature Box that will showcase your business services.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Bring More Traffic To Website', 'start-point')
            ),       
            'startpoint_threecolumn_fet_desc1' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_desc1]',
                'label' => __('First Feature Description', 'start-point'),
                'description' => __('Write short description for your First Feature Box.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Facebook Like button and Like box Plugins Nowadays website builder wants to bring more visitors.', 'start-point')
            ),
            'startpoint_services_title_link1' => array(
                'id' => 'startpoint_options[startpoint_services_title_link1]',
                'label' => __('First feature Link', 'start-point'),
                'description' => __('Enter your text for First feature Link.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),
            // Second Feature Box
            'startpoint_threecolumn_fet_font2' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_font2]',
                'label' => __('Second Icon', 'start-point'),
                'description' => __('Enter the CSS class of the icons you want to use on your 3 column feature. You can find a list of icon classes To increase icon sizes relative to their container, use the fa-lg (33% increase), fa-2x, fa-3x, fa-4x, or fa-5x classes.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'text',
                'default' => ''
            ),
            'startpoint_threecolumn_fet_title2' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_title2]',
                'label' => __('Second Feature Heading', 'start-point'),
                'description' => __('Here you can mention a suitable title that will display the title in 3 column feature area.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Bring More Traffic To Website', 'start-point')
            ),       
            'startpoint_threecolumn_fet_desc2' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_desc2]',
                'label' => __('Second Feature Description', 'start-point'),
                'description' => __('Write short description for your Second Feature Box.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Facebook Like button and Like box Plugins Nowadays website builder wants to bring more visitors.', 'start-point')
            ),
            'startpoint_services_title_link2' => array(
                'id' => 'startpoint_options[startpoint_services_title_link2]',
                'label' => __('Second feature Link', 'start-point'),
                'description' => __('Enter your text for Second feature Link.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),
             // Third Feature Box
            'startpoint_threecolumn_fet_font3' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_font3]',
                'label' => __('Third Feature Image', 'start-point'),
                'description' => __('Enter the CSS class of the icons you want to use on your 3 column feature. You can find a list of icon classes To increase icon sizes relative to their container, use the fa-lg (33% increase), fa-2x, fa-3x, fa-4x, or fa-5x classes.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'text',
                'default' => ''
            ),
            'startpoint_threecolumn_fet_title3' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_title3]',
                'label' => __('Third Feature Heading', 'start-point'),
                'description' => __('Mention the heading for Third Feature Box that will showcase your business services.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Bring More Traffic To Website', 'start-point')
            ),       
            'startpoint_threecolumn_fet_desc3' => array(
                'id' => 'startpoint_options[startpoint_threecolumn_fet_desc3]',
                'label' => __('Third Feature Description', 'start-point'),
                'description' => __('Write short description for your Third Feature Box.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Facebook Like button and Like box Plugins Nowadays website builder wants to bring more visitors.', 'start-point')
            ),
            'startpoint_services_title_link3' => array(
                'id' => 'startpoint_options[startpoint_services_title_link3]',
                'label' => __('Third feature Link', 'start-point'),
                'description' => __('Enter your text for Third feature Link.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),
              // Home Page Blog Headings
            'startpoint_home_blog_heading' => array(
                'id' => 'startpoint_options[startpoint_home_blog_heading]',
                'label' => __('Home Page Main Heading', 'start-point'),
                'description' => __('Mention the punch line for your business here.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Premium WordPress Themes with Single Click Installation.', 'start-point')
            ),
            'startpoint_home_blog_desc' => array(
                'id' => 'startpoint_options[startpoint_home_blog_desc]',
                'label' => __('Home Page Sub Heading', 'start-point'),
                'description' => __('Mention the Sub heading for your business here that will complement the punch line.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Just a Click and your website is ready for use. Your Site is faster to built, easy to use & Search Engine Optimized.', 'start-point')
            ), 
            // Testimonial
             'startpoint_home_testimonial_heading' => array(
                'id' => 'startpoint_options[startpoint_home_testimonial_heading]',
                'label' => __('Home Page Tagline', 'start-point'),
                'description' => __('Mention the text for home page tagline.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Any Important notice with a call to action button can come here.', 'start-point')
            ),
            'startpoint_testimonial_image1' => array(
                'id' => 'startpoint_options[startpoint_testimonial_image1]',
                'label' => __('Author Image', 'start-point'),
                'description' => __('Upload an image for the author. Optimal size is 148X148px.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'image',
                'default' => get_template_directory_uri() . '/images/testimonial-image.png'
            ),
            'startpoint_testimonial_text1' => array(
                'id' => 'startpoint_options[startpoint_testimonial_text1]',
                'label' => __('Testimonial text', 'start-point'),
                'description' => __('Mention the testimonial here.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Any Important notice with a call to action button can come here.', 'start-point')
            ),
            'startpoint_testimonial_name1' => array(
                'id' => 'startpoint_options[startpoint_testimonial_name1]',
                'label' => __('Author Name', 'start-point'),
                'description' => __('Mention the testimonial author name.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('Any Important notice with a call to action button can come here.', 'start-point')
            ),
            // Contact Section
            'startpoint_home_contact_heading' => array(
                'id' => 'startpoint_options[startpoint_home_contact_heading]',
                'label' => __('Contact Section Title', 'start-point'),
                'description' => __('Mention the title for contact section here.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => __('View Portfolio', 'start-point')
            ),
            'startpoint_home_contact_desc' => array(
                'id' => 'startpoint_options[startpoint_home_contact_desc]',
                'label' => __('Description', 'start-point'),
                'description' => __('Mention the description for contact section on home page.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),
            'startpoint_customcss' => array(
                'id' => 'startpoint_options[startpoint_customcss]',
                'label' => __('Custom CSS', 'start-point'),
                'description' => __('Quickly add your custom CSS code to your theme by writing the code in this block.', 'start-point'),
                'type' => 'option',
                'setting_type' => 'textarea',
                'default' => ''
            ),

            'inkthemes_facebook' => array(
                'id' => 'startpoint_options[inkthemes_facebook]',
                'label' => __('Facebook URL', 'dzonia-lite'),
                'description' => __('Enter your Facebook URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_twitter' => array(
                'id' => 'startpoint_options[inkthemes_twitter]',
                'label' => __('Twitter URL', 'dzonia-lite'),
                'description' => __('Enter your Twitter URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_google' => array(
                'id' => 'startpoint_options[inkthemes_google]',
                'label' => __('Google+ URL', 'dzonia-lite'),
                'description' => __('Enter your Google+ URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_rss' => array(
                'id' => 'startpoint_options[inkthemes_rss]',
                'label' => __('RSS URL', 'dzonia-lite'),
                'description' => __('Enter your RSS URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_pinterest' => array(
                'id' => 'startpoint_options[inkthemes_pinterest]',
                'label' => __('Pinterest URL', 'dzonia-lite'),
                'description' => __('Enter your Pinterest URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_linked' => array(
                'id' => 'startpoint_options[inkthemes_linked]',
                'label' => __('LinkedIn URL', 'dzonia-lite'),
                'description' => __('Enter your Linkedin URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_instagram' => array(
                'id' => 'startpoint_options[inkthemes_instagram]',
                'label' => __('Instagram URL', 'dzonia-lite'),
                'description' => __('Enter your Instagram URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_youtube' => array(
                'id' => 'startpoint_options[inkthemes_youtube]',
                'label' => __('Youtube URL', 'dzonia-lite'),
                'description' => __('Enter your Youtube URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_tumblr' => array(
                'id' => 'startpoint_options[inkthemes_tumblr]',
                'label' => __('Tumblr URL', 'dzonia-lite'),
                'description' => __('Enter your Tumblr URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

            'inkthemes_flickr' => array(
                'id' => 'startpoint_options[inkthemes_flickr]',
                'label' => __('Flickr URL', 'dzonia-lite'),
                'description' => __('Enter your Flickr URL if you have one', 'dzonia-lite'),
                'type' => 'option',
                'setting_type' => 'link',
                'default' => '#'
            ),

        );
        return $startpoint_settings;
    }
    public static function StartPoint_Controls($wp_customize) {
        $sections = self::StartPoint_Section_Content();
        $settings = self::StartPoint_Settings();
        foreach ($sections as $section_id => $section_content) {
            foreach ($section_content as $section_content_id) {
                switch ($settings[$section_content_id]['setting_type']) {
                    case 'image':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'startpoint_sanitize_url');
                        $wp_customize->add_control(new WP_Customize_Image_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id']
                                )
                        ));
                        break;
                    case 'text':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'startpoint_sanitize_text');
                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'text'
                                )
                        ));
                        break;
                    case 'textarea':
                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'startpoint_sanitize_textarea');

                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'textarea'
                                )
                        ));
                        break;
                    case 'link':

                        self::add_setting($wp_customize, $settings[$section_content_id]['id'], $settings[$section_content_id]['default'], $settings[$section_content_id]['type'], 'startpoint_sanitize_url');

                        $wp_customize->add_control(new WP_Customize_Control(
                                $wp_customize, $settings[$section_content_id]['id'], array(
                            'label' => $settings[$section_content_id]['label'],
                            'description' => $settings[$section_content_id]['description'],
                            'section' => $section_id,
                            'settings' => $settings[$section_content_id]['id'],
                            'type' => 'text'
                                )
                        ));

                        break;
                    default:
                        break;
                }
            }
        }
    }
    public static function add_setting($wp_customize, $setting_id, $default, $type, $sanitize_callback) {
        $wp_customize->add_setting($setting_id, array(
            'default' => $default,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array('StartPoint_Customizer', $sanitize_callback),
            'type' => $type
                )
        );
    }
    /**
     * adds sanitization callback funtion : textarea
     * @package StartPoint
     */
    public static function startpoint_sanitize_textarea($value) {
        $value = esc_html($value);
        return $value;
    }
    /**
     * adds sanitization callback funtion : url
     * @package StartPoint
     */
    public static function startpoint_sanitize_url($value) {
        $value = esc_url($value);
        return $value;
    }
    /**
     * adds sanitization callback funtion : text
     * @package StartPoint
     */
    public static function startpoint_sanitize_text($value) {
        $value = sanitize_text_field($value);
        return $value;
    }

    /**
     * adds sanitization callback funtion : email
     * @package StartPoint
     */
    public static function startpoint_sanitize_email($value) {
        $value = sanitize_email($value);
        return $value;
    }

    /**
     * adds sanitization callback funtion : number
     * @package StartPoint
     */
    public static function startpoint_sanitize_number($value) {
        $value = preg_replace("/[^0-9+ ]/", "", $value);
        return $value;
    }

}
// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('StartPoint_Customizer', 'StartPoint_Register'));
function inkthemes_registers() {
          wp_register_script( 'inkthemes_jquery_ui', '//code.jquery.com/ui/1.11.0/jquery-ui.js', array("jquery"), true  );
	wp_register_script( 'inkthemes_customizer_script', get_template_directory_uri() . '/functions/js/inkthemes_customizer.js', array("jquery","inkthemes_jquery_ui"), true  );
	wp_enqueue_script( 'inkthemes_customizer_script' );
	wp_localize_script( 'inkthemes_customizer_script', 'ink_advert', array(
            'pro' => __('View PRO version','start-point'),
            'url' => esc_url('https://www.inkthemes.com/market/single-page-wordpress-theme/'),
			'support_text' => __('Need Help!','start-point'),
			'support_url' => esc_url('https://www.inkthemes.com/contact-us/')
            )
            );
}
add_action( 'customize_controls_enqueue_scripts', 'inkthemes_registers' );
