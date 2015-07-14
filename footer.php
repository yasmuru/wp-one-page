<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Wp One Page
 */

$facebook_link          = esc_url( op_get_option( 'facebook_link' ) );
$twitter_link           = esc_url( op_get_option( 'twitter_link' ) );
$gplus_link             = esc_url( op_get_option( 'gplus_link' ) );
?>
 <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; <?php echo bloginfo('name'); ?> <?php echo date('Y'); ?></span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="<?php echo $twitter_link; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="<?php echo $facebook_link; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="<?php echo $gplus_link; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <?php
                    $args = array(
                        'theme_location' => 'primary',
                        'items_wrap'      => '<ul class="list-inline quicklinks">%3$s</ul>'
                    ); 
                    wp_nav_menu($args); 
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
