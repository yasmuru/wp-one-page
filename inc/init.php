<?php
/**
 * Theme functions.
 */

add_filter( 'show_admin_bar', '__return_false' );

/**
 * Add custom post types.
 *
 * @since  1.0.0
 *
 * @return void.
 */
function op_custom_post_types(){

    $labels = array(
        'name'                => _x( 'Benefits', 'Post Type General Name', 'op' ),
        'singular_name'       => _x( 'Benefit', 'Post Type Singular Name', 'op' ),
        'menu_name'           => __( 'Benefits', 'op' ),
        'parent_item_colon'   => __( 'Parent Benefit:', 'op' ),
        'all_items'           => __( 'All Benefits', 'op' ),
        'view_item'           => __( 'View Benefit', 'op' ),
        'add_new_item'        => __( 'Add New Benefit', 'op' ),
        'add_new'             => __( 'Add New', 'op' ),
        'edit_item'           => __( 'Edit Benefit', 'op' ),
        'update_item'         => __( 'Update Benefit', 'op' ),
        'search_items'        => __( 'Search Benefit', 'op' ),
        'not_found'           => __( 'Not found', 'op' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'op' ),
    );
    $args = array(
        'label'               => __( 'Benefits', 'op' ),
        'description'         => __( 'Benefit posts', 'op' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor','thumbnail','excerpt' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => false,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
        'rewrite'             => array( 'slug' => 'benefits' ),
    );
    register_post_type( 'benefits', $args );

    $service_labels = array(
        'name'                => _x( 'Services', 'Post Type General Name', 'op' ),
        'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'op' ),
        'menu_name'           => __( 'Services', 'op' ),
        'parent_item_colon'   => __( 'Parent Service:', 'op' ),
        'all_items'           => __( 'All Services', 'op' ),
        'view_item'           => __( 'View Service', 'op' ),
        'add_new_item'        => __( 'Add New Service', 'op' ),
        'add_new'             => __( 'Add New', 'op' ),
        'edit_item'           => __( 'Edit Service', 'op' ),
        'update_item'         => __( 'Update Service', 'op' ),
        'search_items'        => __( 'Search Service', 'op' ),
        'not_found'           => __( 'Not found', 'op' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'op' ),
    );
    $service_args = array(
        'label'               => __( 'Services', 'op' ),
        'description'         => __( 'Services posts', 'op' ),
        'labels'              => $service_labels,
        'supports'            => array( 'title', 'editor','thumbnail','excerpt' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => false,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
        'rewrite'             => array( 'slug' => 'services' ),
    );
    register_post_type( 'services', $service_args );

}
add_action( 'init', 'op_custom_post_types', 999 );

/**
 * Set post type of custom post types.
 *
 * @since  1.0.0
 *
 * @param Default query conditions.
 *
 * @return  void.
 */
function set_custom_post_type_as_post( $query ) {
    if ( $query->is_single() && $query->is_main_query()) {
        $query->set( 'post_type', array( 'post', 'benefits' ) );
    }
}
add_action( 'pre_get_posts', 'set_custom_post_type_as_post' );

/**
 * Add custom meta boxes.
 *
 * @since  1.0.0
 *
 * @return void.
 */
function op_custom_metabox() {
    add_meta_box( '_icon_custom_fields', __( 'Details', 'op'), 'custom_fields_callback', 'services' );
}
add_action( 'add_meta_boxes', 'op_custom_metabox' );

/**
 * Call back function for custom meta boxes.
 *
 * @since  1.0.0
 *
 * @param  Post $post   Post to create meta box.
 *
 * @return void.
 */
function custom_fields_callback($post) {
    wp_nonce_field( 'custom_fields_meta_box', 'custom_fields_meta_box_nonce' );

    $postype = get_post_type( $post );
    if( $postype == 'services') {
        $post_icon = get_post_meta( $post->ID, '_custom_icon_box', true );
        $image_title = get_post_meta( $post->ID, '_img_title_box', true );
        ?>
        <style>
        .icons-display span:before {
            display: inline-block;
            width: 1em;
            text-align: center;
        }
        .icons-display span:hover, .icons-display span.active {
            background: none repeat scroll 0% 0% #B13CB6;
            color: #FFF;
            cursor: pointer;
            border: solid 2px #B13CB6;
        }
        .icon-place {
            top: 10px;
            right: 0;
            left: 0;
            margin: 0 auto;
            padding: 8px 5px;
            width: 30px;
            height: 30px;
            color: #fff;
            font-size: 30px;
            background: #00aff7;
            border: solid 2px #00aff7;
            border-radius: 30%;
        }
        </style>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('.icon-place').click( function() {
                    $(this).addClass('active');
                    $(this).siblings().removeClass('active');
                    $("#post_icon").val( $(this).attr('data-value'));
                });
                $('.icons-display span').each( function() {

                    if( $("#post_icon").val() == $(this).attr('data-value') ) {
                        $(this).addClass('active');
                    }
                });
            });
        </script>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="post_icon"> <?php _e( 'Select Icon For This Service: ', 'bs' ); ?> </label>
                </th>
                <td>
                    <div class="icons-display">
                        <span class="fa fa-bar-chart icon-place"  data-value="fa fa-bar-chart" title="Chart"></span>
                        <span class="fa fa-paper-plane icon-place"  data-value="fa fa-paper-plane" title="Plane"></span>
                        <span class="fa fa-newspaper-o icon-place" data-value="fa fa-newspaper-o" title="News Paper"></span>
                        <span class="fa fa-bell icon-place" data-value="fa fa-bell" title="Bell"></span>
                        <span class="fa fa-table icon-place" data-value="fa fa-table" title="Table"></span>
                        <span class="fa fa-book icon-place" data-value="fa fa-book" title="Book"></span>
                        <span class="fa fa-group icon-place" data-value="fa fa-group" title="Group"></span>
                        <span class="fa fa-check icon-place" data-value="fa fa-check" title="Check"></span>
                        <span class="fa fa-money icon-place" data-value="fa fa-money" title="Money"></span>
                        <span class="fa fa-copy icon-place" data-value="fa fa-copy" title="Copy"></span>
                        <span class="fa fa-user icon-place" data-value="fa fa-user" title="User"></span>
                        <span class="fa fa-calendar icon-place" data-value="fa fa-calendar" title="Calendar"></span>
                    </div>
                    <input type="hidden" id="post_icon" name="post_icon" value="<?php echo $post_icon; ?>">
                </td>
            </tr>
        </table>

        <?php
    }
}

/**
 * Save career custom meta box values when save/update post.
 *
 * @since  1.0.0
 *
 * @param  int    $post_id Post's id.
 *
 * @return void.
 */
function save_services_custombox( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if( isset( $_POST['services'] ) && 'page' == $_POST['services'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
          return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

     // Check if our nonce is set.
    if ( ! isset( $_POST['custom_fields_meta_box_nonce'] ) ) {
        return;
    }

    if( ! wp_verify_nonce( $_POST['custom_fields_meta_box_nonce'], 'custom_fields_meta_box' ) ) {
        return;
    }

    $icon_class = '';

    if( isset( $_POST['post_icon'] ) ) {
        $icon_class = esc_attr( $_POST['post_icon'] );
    }
    update_post_meta( $post_id, '_custom_icon_box', $icon_class );
}
add_action( 'save_post', 'save_services_custombox' );


/**
 * Default option values. Fetches when db options not created.
 *
 * @since  1.0.0
 *
 */
if ( ! function_exists( 'op_get_option' ) ) {
    function op_get_option( $key ) {

        $theme_options      = get_option( '_one_page_options' );

        $defaults           = array(
            'facebook_link'     => 'https://facebook.com',
            'twitter_link'      => 'https://twitter.com',
            'gplus_link'        => 'https://plus.google.com',
            'contact_address'   => 'Address',
            'client_ids'        => '',
            'slider_title'      => 'Slider',
            'about_title'       => "About us",
            'about_content'     => 'lorum ipsum lorum ipsum lorum ipsum lorum ipsum lorum ipsum lorum ipsum lorum ipsum lorum ipsum',
        );

        $theme_options = wp_parse_args( $theme_options, $defaults );

        if ( isset( $theme_options[ $key ] ) )
            return $theme_options[ $key ];

        return false;
    }
}