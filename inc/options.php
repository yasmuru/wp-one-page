<?php
/**
 * Theme Settings.
 */
if(!defined('ABSPATH')) exit;

/**
 * Setup Theme Admin Menu
 */
function setup_theme_admin_menus() {
    add_submenu_page('themes.php',
        'Theme Settings', 'Theme Settings', 'manage_options',
        'theme-settings-page', 'theme_front_page_settings');
}
add_action('admin_menu', 'setup_theme_admin_menus');

/**
 * Theme Options Page
 */
function theme_front_page_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
?>
<div class="wrap">
<?php
    if (isset($_POST["update_settings"])) {
        check_admin_referer('update-theme-config');

        $theme_options          = array(
            'slider_title'      => esc_attr( wp_unslash( $_POST['slider_title'] ) ),
            'about_title'       => esc_attr( wp_unslash( $_POST['about_title'] ) ),
            'about_content'     => esc_html( wp_unslash( $_POST['about_content'] ) ),
            'client_ids'        => esc_attr( $_POST['client_ids'] ),
            'facebook_link'     => esc_url( $_POST['facebook_link'] ),
            'twitter_link'      => esc_url( $_POST['twitter_link'] ),
            'gplus_link'        => esc_url( $_POST['gplus_link'] ),
            'contact_address'   => esc_html( wp_unslash( $_POST['contact_address'] ) ),
        );
        update_option('_one_page_options', $theme_options);
    ?>
        <div id="message" class="updated">Settings saved</div>
    <?php

    }

    $slider_title           = esc_attr( wp_unslash( op_get_option( 'slider_title' ) ) );
    $about_title            = esc_attr( wp_unslash( op_get_option( 'about_title' ) ) );
    $about_content          = html_entity_decode( wp_unslash( op_get_option( 'about_content' ) ) );
    $client_ids             = esc_attr( op_get_option( 'client_ids' ) );
    $facebook_link          = esc_url( op_get_option( 'facebook_link' ) );
    $twitter_link           = esc_url( op_get_option( 'twitter_link' ) );
    $gplus_link             = esc_url( op_get_option( 'gplus_link' ) );
    $contact_address        = html_entity_decode( esc_html( wp_unslash( op_get_option( 'contact_address' ) ) ) );

    ?>
<h2>Theme Settings</h2>

<form method="POST" action="">
    <?php wp_nonce_field('update-theme-config') ?>
    <input type="hidden" name="update_settings" value="Y" />

    <table class="form-table">
        <tr valign="top">
            <th scope="row"><label for="slider_title"><?php _e( 'Slider Title', 'op' ); ?></label></th>
            <td>
                <input type="text" name="slider_title" id="slider_title" class="code large-text" value="<?php echo $slider_title; ?>">
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="about_title"><?php _e( 'About Us Title', 'op' ); ?></label></th>
            <td>
                <input type="text" name="about_title" id="about_title" class="code large-text" value="<?php echo $about_title; ?>">
            </td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="about_content"><?php _e( 'About Content', 'op' ); ?></label></th>
            <td>
                <?php wp_editor( $about_content, 'about_content', array( 'textarea_rows' => '10', 'media_buttons' => false ) ); ?>
            </td>
        </th>
        <tr valign="top">
            <th scope="row"><label for="client_images"> <?php _e( 'Upload Client Images', 'op' ); ?></label></th>
            <td>
                <div class="toggle-image">
                    <input id="client_image_button" class="button" type="button" value="Upload Images" />
                    <span class="show-image">Hide images</span>
                    <ul id="c_images">
                        <input id="client_ids" name="client_ids" type="hidden" value="<?php echo $client_ids; ?>" />
                        <?php
                            if( ! empty( $client_ids ) ) {
                                $clients_ids = explode( ';', $client_ids );
                                foreach( $clients_ids as $id ) {
                                    $generated_id = $id . ';';
                                    $id = str_replace('id-', '', $id );
                                    if( ! empty( $id ) ) {
                                        echo '<li id="' . $generated_id . '" ><span class="c-close"></span>';
                                        echo wp_get_attachment_image( $id, 'medium' );
                                        echo '</li>';
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><label for="facebook_link"><?php _e( 'Facebook URL', 'op' ); ?></label></th>
            <td>
                <input type="text" name="facebook_link" id="facebook_link" value="<?php echo $facebook_link; ?>" class="code large-text" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><label for="twitter_link"><?php _e( 'Twitter URL', 'op' ); ?></label></th>
            <td>
                <input type="text" name="twitter_link" id="facebook_link" value="<?php echo $twitter_link; ?>" class="code large-text" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><label for="gplus_link"><?php _e( 'Google Plus URL', 'op' ); ?></label></th>
            <td>
                <input type="text" name="gplus_link" id="gplus_link" value="<?php echo $gplus_link; ?>" class="code large-text" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><label for="contact_address"><?php _e( 'Contact Address', 'op' ); ?></label></th>
            <td>
                <?php wp_editor( $contact_address, 'contact_address', array( 'textarea_rows' => '10', 'media_buttons' => false ) ); ?>
            </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>
</form>
<?php
    wp_enqueue_script( 'admin-script', THEME_JS_URL . '/admin.js', array(), '1.0.0' );
}
?>