<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function login_customize_register($wp_customize) {
    $wp_customize->add_panel( 'login_panel', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'title'          => __('Wordpress Login Customizer', login_customize),
        'description'    => __('This section allows you to customize the login page', login_customize),
    ));

    // Login Screen Logo Section
    $wp_customize->add_section('login_logo_section', array(
        'priority' => 5,
        'title' => __('Logo', login_customize),
        'panel'  => 'login_panel',
    ));

    // Login Screen Logo Setting and Control
    $wp_customize->add_setting('login_logo', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'login_logo', array(
        'label' => __('Login Logo', login_customize),
        'section' => 'login_logo_section',
        'priority' => 5,
        'settings' => 'login_logo'
    )));

    // Login Screen Logo Width Setting and Control
    $wp_customize->add_setting('login_logo_width', array(
        'default' => '85px',
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('login_logo_width', array(
        'label' => __('Logo Width', login_customize),
        'section' => 'login_logo_section',
        'priority' => 10,
        'settings' => 'login_logo_width'
    ));

    // Login Screen Logo Height Setting and Control
    $wp_customize->add_setting('login_logo_height', array(
        'default' => '85px',
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('login_logo_height', array(
        'label' => __('Logo Height', login_customize),
        'section' => 'login_logo_section',
        'priority' => 15,
        'settings' => 'login_logo_height'
    ));


    // Login Screen Background Image Section
    $wp_customize->add_section('login_background_section', array(
        'priority' => 10,
        'title' => __('Background', login_customize),
        'panel'  => 'login_panel',
    ));

    // Login Screen Background Image Setting and Control
    $wp_customize->add_setting('login_bg_image', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'login_bg_image', array(
        'label' => __('Background Image', login_customize),
        'section' => 'login_background_section',
        'priority' => 5,
        'settings' => 'login_bg_image'
    )));

    // Login Screen Background Position Settings and Control
    $wp_customize->add_setting('login_bg_position', array(
        'type' => 'option',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('login_bg_position', array(
        'label' => __('Background Position (using Length Values, Percentages, or Keywords)', login_customize),
        'section' => 'login_background_section',
        'priority' => 15,
        'settings' => 'login_bg_position'
    ));

    // Login Screen Background Color Setting and Control
    $wp_customize->add_setting('login_background_color', array(
        'type' => 'option',
        'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control(
         new WP_Customize_Color_Control(
          $wp_customize,
           'login_background_color',
            array(
                'label'      => __( 'Background Color', login_customize ),
                'section'    => 'login_background_section',
                'settings'   => 'login_background_color',
            )
        )
    );
}

// Register the login_customize_register function created above to WP built in customize_register function
add_action('customize_register', 'login_customize_register');


function login_customizer() {
  $logo_url = get_option('login_logo');
  $logo_width = get_option('login_logo_width');
  $logo_height = get_option('login_logo_height');
  $bg_img = get_option('login_bg_image');
  $bg_position = get_option('login_bg_position');
  $bg_color = get_option('login_background_color');
?>

<!-- Stylesheets to be generated as a result of the above function -->
<style type="text/css">
    html, body {
        <?php if( !empty($bg_img)) : ?>
            background-image: url(<?php echo $bg_img; ?>) !important;
            background-position: <?php echo $bg_position; ?> !important;
        <?php endif; ?>
    }

    html, body.login {
        background-color: <?php echo $bg_color; ?> !important;
    }

    body.login div#login h1 a {
        <?php if( !empty($logo_url)) : ?>
          background-image: url(<?php echo $logo_url; ?>) !important;
        <?php endif; ?>

        <?php if( !empty($logo_width)) : ?>
            width: <?php echo $logo_width; ?> !important;
        <?php endif; ?>

        <?php if( !empty($logo_height)) : ?>
            height: <?php echo $logo_height; ?> !important;
        <?php endif; ?>

        <?php if( !empty($logo_width) || !empty($logo_height)) : ?>
            background-size: <?php echo $logo_width; ?> <?php echo $logo_height; ?> !important;
        <?php endif; ?>
    }
</style>

<?php }

add_action( 'login_enqueue_scripts', 'login_customizer' );

// Bonus!!! By default, the login screen logo once clicked links to http://wordpress.org. The below function helps the logo link to your website's homepage
function login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'login_logo_url' );
