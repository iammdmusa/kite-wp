<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }
                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../functions/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../functions/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'redux-framework-demo' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'redux-framework-demo' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'redux-framework-demo' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'redux-framework-demo' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'redux-framework-demo' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'redux-framework-demo' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'title'  => __( 'Kite Global Settings', 'redux-framework-demo' ),
                    'desc'   => __( 'Here Your Can Control The Landing Page Title, Logo, Afix Logo, Fabicon,Text size,Text color and many more.','redux-framework-demo' ),
                    'icon'   => 'dashicons dashicons-admin-generic',
                    'fields' => array(

                          array(
                            'id'       => 'homePage',
                            'type'     => 'text',
                            'title'    => __( 'Landing Page Title', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Home',
                        ),
                        array(
                            'id'       => 'kite_logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Kite Logo', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/logo.png' ),
                        ),
                        array(
                            'id'       => 'kite_logo_afix',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Kite Logo collapse', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/logo-bw.png' ),
                        ),
                        array(
                            'id'       => 'fabicon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Kite Fabicon', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                            'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/fabicon.png' ),
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );
                $this->sections[] = array(
                    'icon'    => 'dashicons dashicons-admin-settings',
                    'title'   => __( 'Menu settings', 'redux-framework-demo' ),
                    'heading' => __( 'OnePage Menu Navigation Settings', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">You can turn on/off section form this section.</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'slider_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off slider ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'servicePage_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Service Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'about_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off About Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'portfolio_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Protfolio Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'team_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Team Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'price_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Price Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'testimonial_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Testimonial Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'blog_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Blog Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'contact_switch-on',
                            'type'     => 'switch',
                            'title'    => __( 'Do You Turn off Contact Section ?', 'redux-framework-demo' ),
                            'subtitle' => __( 'default its On if you clicked then it will off.', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
        
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-website',
                    'title'   => __( 'Slider Section', 'redux-framework-demo' ),
                    'heading' => __( 'slider options.', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">To Do</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id' => 'section_slider_info',
                            'type' => 'info',
                            'title' => __('Create a new Slide from <a href="' . site_url() . '/wp-admin/post-new.php?post_type=slider">here</a> ', 'resumi-admin'),
                            'style' => 'warning'
                        ),
                        array(
                            'id'       => 'slider_max_number',
                            'type'     => 'text',
                            'title'    => __( 'Maximum Number of Slide', 'redux-framework-demo' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'msg'      => 'custom error message',
                            'default'  => '3',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-torso',
                    'title'   => __( 'About Section', 'redux-framework-demo' ),
                    'heading' => __( 'Customize Your About Page Section Form Here.', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'aboutPage',
                            'type'     => 'text',
                            'title'    => __( 'For Menu Title', 'redux-framework-demo' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'About',
                        ),
                        array(
                            'id'       => 'aboutPage_bg',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'About Section Image Background :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/about-01.jpg' ),
                        ),
                        array(
                            'id'       => 'aboutPage_title',
                            'type'     => 'text',
                            'title'    => __( 'About Section Title', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'About us',
                        ),
                        array(
                            'id'       => 'aboutPage_subTitle',
                            'type'     => 'text',
                            'title'    => __( 'About Section Sub-Title', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'We’re passionate about simplifying',
                        ),
                        array(
                            'id'       => 'aboutPage_item1',
                            'type'     => 'text',
                            'title'    => __( 'Item 1 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Powerful Management Tools',
                        ),
                        array(
                            'id'       => 'aboutPage_item1_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 1 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'aboutPage_item1_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 1 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/icon_1.png' ),
                        ),
                        array(
                            'id'       => 'aboutPage_item2',
                            'type'     => 'text',
                            'title'    => __( 'Item 2 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Social Media Operation',
                        ),
                        array(
                            'id'       => 'aboutPage_item2_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 2 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'aboutPage_item2_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 2 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/icon_2.png' ),
                        ),
                        array(
                            'id'       => 'aboutPage_item3',
                            'type'     => 'text',
                            'title'    => __( 'Item 3 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Cost Effective',
                        ),
                        array(
                            'id'       => 'aboutPage_item3_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 3 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'aboutPage_item3_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 3 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/icon_3.png' ),
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-puzzle',
                    'title'   => __( 'Service Section', 'redux-framework-demo' ),
                    'heading' => __( 'Customize Your Service Page Section Form Here.', 'redux-framework-demo' ),
                    'desc'    => __( '', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'servicePage',
                            'type'     => 'text',
                            'title'    => __( 'Page Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Service Page Title for Menu.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Service',
                        ),
                        array(
                            'id'       => 'servicePage_title',
                            'type'     => 'text',
                            'title'    => __( 'Service Section Title', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'What We’re Doing',
                        ),
                        array(
                            'id'       => 'servicePage_subTitle',
                            'type'     => 'text',
                            'title'    => __( 'Service Section Sub-Title', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'We’re passionate about simplifying',
                        ),
                        array(
                            'id'       => 'servicePage_bg',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Service Section Image Background :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/back_img_6.png' ),
                        ),
                        array(
                            'id'       => 'servicePage_left_img',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Service: Featured Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/device-1.png' ),
                        ),
                        array(
                            'id'       => 'servicePage_item1',
                            'type'     => 'text',
                            'title'    => __( 'Item 1 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Web Development',
                        ),
                        array(
                            'id'       => 'servicePage_item1_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 1 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'servicePage_item1_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 1 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/web.png' ),
                        ),
                        array(
                            'id'       => 'servicePage_item2',
                            'type'     => 'text',
                            'title'    => __( 'Item 2 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Programming',
                        ),
                        array(
                            'id'       => 'servicePage_item2_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 2 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'servicePage_item2_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 2 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/programming.png' ),
                        ),
                        array(
                            'id'       => 'servicePage_item3',
                            'type'     => 'text',
                            'title'    => __( 'Item 3 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'UI & UX Design',
                        ),
                        array(
                            'id'       => 'servicePage_item3_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 3 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'servicePage_item3_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 3 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/ui-ux.png' ),
                        ),
                        array(
                            'id'       => 'servicePage_item4',
                            'type'     => 'text',
                            'title'    => __( 'Item 4 Title:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'CMS Services',
                        ),
                        array(
                            'id'       => 'servicePage_item4_text',
                            'type'     => 'textarea',
                            'title'    => __( 'Item 4 Description:', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => 'Lorem quis biben dum auctor. Aenean sollicitudin, lorem quis biben dum auctor, nisi elit consequat ipsum',
                        ),
                        array(
                            'id'       => 'servicePage_item4_icon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Item 4 Image :', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            'desc'     => __( 'You can use Your custom background for this section.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_stylesheet_directory_uri().'/img/cms.png' ),
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-list',
                    'title'   => __( 'Portfolio Section', 'redux-framework-demo' ),
                    'heading' => __( 'Validate ALL fields within Redux.', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'portfolioPage',
                            'type'     => 'text',
                            'title'    => __( 'Portfolio Page Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Portfolio Page Title For Menu', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Portfolio',
                        ),
                        array(
                            'id'       => 'portfolio-sub-title',
                            'type'     => 'text',
                            'title'    => __( 'Protfolio Page Sub-Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Protfolio Page Sub-Title For Menu', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Take a moment to view & explore our new features',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-list-alt',
                    'title'   => __( 'Testimonial Section', 'redux-framework-demo' ),
                    'heading' => __( 'Testimonial Section.', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'testimonialPage',
                            'type'     => 'text',
                            'title'    => __( 'Testimonial Page Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Testimonial Page for Menu info.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Testimonial',
                        ),
                        array(
                            'id'       => 'testimonial-title',
                            'type'     => 'text',
                            'title'    => __( 'Testimonial Home page Section Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Testimonial Home page Section Title.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Clients Gratitude',
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'fa fa-bell-o',
                    'title'   => __( 'Team Section', 'redux-framework-demo' ),
                    'heading' => __( 'Team Member Description', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'teamPage',
                            'type'     => 'text',
                            'title'    => __( 'Team Page Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Team Page for Menu info.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Team',
                        ),
                        array(
                            'id'       => 'team_section_title',
                            'type'     => 'text',
                            'title'    => __( 'Team Section Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Section Title.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Passionate team members',
                        ),
                        array(
                            'id'       => 'team_max_display',
                            'type'     => 'text',
                            'title'    => __( 'Number of Team member Display?', 'redux-framework-demo' ),
                            'desc'     => __( 'Maximum Number', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'msg'      => 'custom error message',
                            'default'  => '4',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-eur',
                    'title'   => __( 'Price Section', 'redux-framework-demo' ),
                    'heading' => __( 'Validate ALL fields within Redux.', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'pricePage',
                            'type'     => 'text',
                            'title'    => __( 'Text Option - Email Validated', 'redux-framework-demo' ),
                            'subtitle' => __( 'This is a little space under the Field Title in the Options table, additional info is good in here.', 'redux-framework-demo' ),
                            'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'service',
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons dashicons-screenoptions',
                    'title'   => __( 'Blog Section', 'redux-framework-demo' ),
                    'heading' => __( 'Customize your Blog ', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'blogPage',
                            'type'     => 'text',
                            'title'    => __( 'Page Title', 'redux-framework-demo' ),
                            'subtitle' => __( 'This is Title for Menu section', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Blog',
                        ),
                        array(
                            'id'       => 'blogPage_subtitle',
                            'type'     => 'text',
                            'title'    => __( 'Section Title', 'redux-framework-demo' ),
                            'subtitle' => __( 'This title is for blog section in Kite home page ', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'OUR COZY BLOG',
                        ),
                        array(
                            'id'       => 'blogPage_subtitle_2',
                            'type'     => 'text',
                            'title'    => __( 'Section Sub Title', 'redux-framework-demo' ),
                            'subtitle' => __( 'This sub title is for blog section in Kite home page ', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'We are here to help you as you need...',
                        ),
                        array(
                            'id'       => 'blog_limit',
                            'type'     => 'text',
                            'title'    => __( 'Blog Post Limit', 'redux-framework-demo' ),
                            'subtitle' => __( 'this number of post will display in home page ', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'msg'      => 'custom error message',
                            'default'  => '4',
                        ),
                        array(
                            'id'       => 'blog_style',
                            'type'     => 'switch',
                            'title'    => __( 'Blog Appearance', 'redux-framework-demo' ),
                            'subtitle' => __( 'this number of post will display in home page ', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'msg'      => 'custom error message',
                            'default'  => false,
                        ),
                        array(
                            'id'       => 'blog_style_opt',
                            'type'     => 'select',
                            'title'    => __( 'Blog Appearance option', 'redux-framework-demo' ),
                            'subtitle' => __( 'this number of post will display in home page ', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'msg'      => 'custom error message',
                            'required' => array( 'blog_style', "=", true ),
                            'options'  => array( '1' => 'default', '2' => 'grid view', ),
                            'default'  => '1',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-laptop',
                    'title'   => __( 'Contact Section', 'redux-framework-demo' ),
                    'heading' => __( 'Customize Your Contact page using Kite Admin ', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'contactPage',
                            'type'     => 'text',
                            'title'    => __( 'Contact Page Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Contact page Title for Menu.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Contact',
                        ),
                        array(
                            'id'       => 'contact_form',
                            'type'     => 'editor',
                            'title'    => __( 'Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Contact page Title for Home Page.', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => '[contact-form-7 id="9" title="Contact form 1"]',
                        ),
                        array(
                            'id'       => 'map_url',
                            'type'     => 'editor',
                            'title'    => __( 'Google Map Embed URL', 'redux-framework-demo' ),
                            'desc'     => __( 'Go to https://maps.google.com/ and put your location then click on the bottom of the right settings icon then click again then you can see a popup after you will see "Embed" option clicl then just copy the "src" link and put here ', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.2242213618433!2d90.36114870000002!3d23.77502859999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0bb4e5e3647%3A0xe90b798a3d7965e9!2sGolden+St%2C+Dhaka!5e0!3m2!1sen!2sbd!4v1423335332288',
                        ),
                        array(
                            'id'       => 'address_title',
                            'type'     => 'text',
                            'title'    => __( 'Address Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Address Title', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'KITE: CloudBee',
                        ),
                        array(
                            'id'       => 'the_address',
                            'type'     => 'editor',
                            'title'    => __( 'Address Details', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Faruque Rupayan Tower (5th Floor) 32, Kemal Ataturk Avenue, Banani Dhaka-1213, Bangladesh.',
                        ),
                        array(
                            'id'       => 'address_web',
                            'type'     => 'text',
                            'title'    => __( 'Address website', 'redux-framework-demo' ),
                            'desc'     => __( '', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'http://www.shuvomusa.me',
                        ),
                    )
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-laptop',
                    'title'   => __( 'Footer Copyright ', 'redux-framework-demo' ),
                    'heading' => __( 'Customize Your Footer Copyright using Kite Admin ', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'copyright_info',
                            'type'     => 'text',
                            'title'    => __( 'Copyright Info', 'redux-framework-demo' ),
                            'desc'     => __( 'Customize your Copyright Info', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Copyright © KITE 2014',
                        ),
                        array(
                            'id'       => 'dev_credit_off',
                            'type'     => 'switch',
                            'title'    => __( 'Customize Designed & Developed by ?', 'redux-framework-demo' ),
                            'desc'     => __( 'if customize Designed & Developed by info then please turn on this..', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => false,
                        ),
                        array(
                            'id'       => 'dev_credit_info',
                            'type'     => 'editor',
                            'title'    => __( 'Designed & Developed by', 'redux-framework-demo' ),
                            'desc'     => __( 'if you write your own info then put ehre', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'required' => array( 'dev_credit_off', "=", true ),
                            'default'  => 'Designed & Developed by <a href="http://cloudbee-bd.com">CloudBee</a>',
                        ),

                    ),
                );
                $this->sections[] = array(
                    'icon'    => 'el-icon-laptop',
                    'title'   => __( 'Social Media', 'redux-framework-demo' ),
                    'heading' => __( '', 'redux-framework-demo' ),
                    'desc'    => __( '<p class="description">This is the Description. Again HTML is allowed2</p>', 'redux-framework-demo' ),
                    'fields'  => array(
                        array(
                            'id'       => 'social-media-title',
                            'type'     => 'text',
                            'title'    => __( 'Title', 'redux-framework-demo' ),
                            'desc'     => __( 'Customize your own Title', 'redux-framework-demo' ),
                            'validate' => 'text',
                            'msg'      => 'custom error message',
                            'default'  => 'Social Media',
                        ),
                        array(
                            'id'       => 'social_media_fb',
                            'type'     => 'text',
                            'title'    => __( 'Facebook Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                        array(
                            'id'       => 'social_media_tw',
                            'type'     => 'text',
                            'title'    => __( 'Twitter Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                        array(
                            'id'       => 'social_media_gplus',
                            'type'     => 'text',
                            'title'    => __( 'GooglePlus Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                        array(
                            'id'       => 'social_media_linkedin',
                            'type'     => 'text',
                            'title'    => __( 'Linkedin Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                        array(
                            'id'       => 'social_media_pin',
                            'type'     => 'text',
                            'title'    => __( 'Pinterest Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                        array(
                            'id'       => 'social_media_instagram',
                            'type'     => 'text',
                            'title'    => __( 'Instagram Page Link', 'redux-framework-demo' ),
                            'desc'     => __( 'share your info with glob', 'redux-framework-demo' ),
                            'msg'      => 'custom error message',
                            'default'  => '#',
                        ),
                    ),
                );

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'redux-framework-demo' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'redux-framework-demo' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el-icon-list-alt',
                        'title'  => __( 'Documentation', 'redux-framework-demo' ),
                        'fields' => array(
                            array(
                                'id'       => '17',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                            ),
                        ),
                    );
                }

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'redux-framework-demo' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', 'redux-framework-demo' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'kite_muri',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Kite Settings', 'redux-framework-demo' ),
                    'page_title'           => __( 'Kite Settings', 'redux-framework-demo' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => false,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => '',
                    'title' => __( 'Documentation', 'redux-framework-demo' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => '',
                    'title' => __( 'Support', 'redux-framework-demo' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => '',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => '',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    //$this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
                } else {
                    //$this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p>If having any issues in run time please let us know via support forum,Thanks Advance<br>Kite Team</p>', 'redux-framework-demo' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';
                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Kite has already been called";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';
            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }
            return $return;
        }
    endif;
