<?php
$functions_path = get_template_directory() . '/functions/';
include_once $functions_path . 'inkthemes-functions.php';
require_once ($functions_path . 'define_template.php'); 
require_once ($functions_path . 'dynamic-image.php');
require_once ($functions_path . 'themes-page.php');
require_once ($functions_path . 'customizer.php');
add_theme_support( "custom-header");
/* ----------------------------------------------------------------------------------- */
/* jQuery Enqueue */
/* ----------------------------------------------------------------------------------- */
function startpoint_wp_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('startpoint-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'));
        wp_enqueue_script('startpoint-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('startpoint-mmenu', get_template_directory_uri() . '/js/jquery.mmenu.js', array('jquery'));
        wp_enqueue_script('startpoint-singlepagenav', get_template_directory_uri() . '/js/jquery.singlePageNav.min.js', array('jquery'));
        wp_enqueue_script('startpoint-modernize', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'));
        wp_enqueue_script('startpoint-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
        if (is_singular() and get_site_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('wp_enqueue_scripts', 'startpoint_wp_enqueue_scripts');
//Add plugin notification 
require_once(get_template_directory() . '/functions/plugin-activation.php');
require_once(get_template_directory() . '/functions/inkthemes-plugin-notify.php');
add_action('tgmpa_register', 'inkthemes_plugins_notify');
//Theme option get values
function startpoint_get_option($name) {
    $options = get_option('startpoint_options');
    if (isset($options[$name]))
        return $options[$name];
}
//Theme option update
function startpoint_update_option($name, $value) {
    $options = get_option('startpoint_options');
    $options[$name] = $value;
    return update_option('startpoint_options', $options);
}
//Theme option delete
function startpoint_delete_option($name) {
    $options = get_option('startpoint_options');
    unset($options[$name]);
    return update_option('startpoint_options', $options);
}
// comment form placeholder
add_filter('comment_form_default_fields', 'startpoint_comment_placeholders');
/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
function startpoint_comment_placeholders($fields) {
    $fields['author'] = str_replace(
            '<input', '<input placeholder="'
            /** I use _x() here to make your translators life easier. :)
             * See http://codex.wordpress.org/Function_Reference/_x
             */
            . _x(
                    'Name', 'comment form placeholder', 'start-point'
            )
            . '"', $fields['author']
    );
    $fields['email'] = str_replace(
            '<input id="email" name="email" type="text"', '<input type="email" placeholder="contact@example.com"  id="email" name="email"', $fields['email']
    );
    $fields['url'] = str_replace(
            '<input id="url" name="url" type="text"',
            // Again: a better 'type' attribute value.
            '<input placeholder="http://example.com" id="url" name="url" type="url"', $fields['url']
    );


    return $fields;
}

// placeholder to textarea
function startpoint_comment_textarea_field($comment_field) {

    $comment_field = '<p class="comment-form-comment">
            <textarea required placeholder="Enter Your Comments" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

    return $comment_field;
}

add_filter('comment_form_field_comment', 'startpoint_comment_textarea_field');

//comment text
function stefan_wrap_comment_text($content) {
    return "<div class=\"comment-text\"><a class='commenttext-arrow'></a>" . $content . "</div>";
}

add_filter('comment_text', 'stefan_wrap_comment_text');

function startpoint_breadcrum_block() {
    ?>
    <div class="breadcrum-wrapper" <?php if (startpoint_get_option('startpoint_headbg') != '') { ?>
             style="background: url(<?php echo startpoint_get_option('startpoint_headbg'); ?>) no-repeat center;"
             <?php
         } else {
             
         }
         ?>>
        <div class="container">
            <div class="row">
                <div class="breadcrum-inner">
                    <div class="col-md-12">
                        <div class="breadcrum clearfix">
                            <h4><?php if (function_exists('startpoint_breadcrumbs')) startpoint_breadcrumbs(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
function startpoint_tracking_admin_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if (!get_user_meta($user_id, 'wp_email_tracking_ignore_notice')) {
        ?>
        <div class="updated um-admin-notice"><p><?php _e('Allow Startpoint theme to send you setup guide? Opt-in to our newsletter and we will immediately e-mail you a setup guide along with 20% discount which you can use to purchase any theme.', 'start-point'); ?></p><p><a href="<?php echo get_template_directory_uri() . '/functions/smtp.php?wp_email_tracking=email_smtp_allow_tracking'; ?>" class="button button-primary"><?php _e('Allow Sending', 'start-point'); ?></a>&nbsp;<a href="<?php echo get_template_directory_uri() . '/functions/smtp.php?wp_email_tracking=email_smtp_hide_tracking'; ?>" class="button-secondary"><?php _e('Do not allow', 'start-point'); ?></a></p></div>
        <?php
    }
}

add_action('admin_notices', 'startpoint_tracking_admin_notice');
