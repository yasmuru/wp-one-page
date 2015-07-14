<?php
/**
 * Template Name: Contact
 */

if( function_exists('wpcf7_enqueue_scripts') ) {
    wpcf7_enqueue_scripts();
}

if( function_exists('wpcf7_enqueue_styles') ) {
    wpcf7_enqueue_styles();
}

get_header(); ?>

<section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo do_shortcode('[contact-form-7 id="36" title="Contact form 1"]'); ?>         
                </div>
            </div>
        </div>
    </section>

    <section id="address">
    	<div class="contact-address">
            <?php 
            $contact_address        = html_entity_decode( esc_html( wp_unslash( op_get_option( 'contact_address' ) ) ) );
            echo $contact_address;
            ?>
        </div>
    </section>
<?php
get_footer();