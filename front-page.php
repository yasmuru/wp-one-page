<?php
/**
 * Front page structure.
 */
get_header();

$slider_title           = esc_attr( wp_unslash( op_get_option( 'slider_title' ) ) );
$about_title            = esc_attr( wp_unslash( op_get_option( 'about_title' ) ) );
$about_content          = html_entity_decode( wp_unslash( op_get_option( 'about_content' ) ) );
?>

<section id="home" data-speed="10" data-type="background">
  <div class="header-content">
        <div class="header-content-inner">
            <h1><?php echo $slider_title; ?></h1>
            <hr>
        </div>
    </div>
</section>

<section class="bg-primary" id="about" data-speed="10" data-type="background" data-echo-background="<?php echo THEME_IMG_URL . '/photo-3.jpg';?>">  
    <span class="layer"></span>
    <div class="header-content">
        <div class="header-content-inner">
            <h2 class="section-heading"><?php echo $about_title; ?></h2>
            <hr class="light">
            <p class="text-faded"><?php echo $about_content; ?></p>
        </div>
    </div>
</section>

<?php
    $service_args = array(
        'post_type' => 'services',
        'showposts' => -1,
        'order'     => 'ASC',
    );
    $service_posts = new WP_Query( $service_args );

    if( $service_posts->have_posts() ) :
        echo '<section id="services" data-echo-background="' . THEME_IMG_URL . '/photo-7.jpg">';
        echo '<span class="layer"></span>';
        echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">';
        echo '<h2 class="section-heading">At Your Service</h2>';
        echo '<hr class="primary"></div></div></div>';

        echo '<div class="container">';
        $service_count = 0;
        while( $service_posts->have_posts() ) : $service_posts->the_post();
            
            $post_icon = get_post_meta( get_the_ID(), '_custom_icon_box', true );     
            if( $service_count == 0 ) {
                echo '<div class="row">';
            }         

            echo '<div class="col-lg-3 col-md-6 text-center">';
            echo '<div class="service-box wow bounceIn">';
            echo '<a data-toggle="modal" data-target="#' . str_replace(' ', '', get_the_title() ) . 'Modal">';
            echo '<i class="' . $post_icon . ' fa-4x text-primary" style="visibility: visible; -webkit-animation: bounceIn;"></i>';
            echo '<h3>' . get_the_title() . '</h3>';
            echo '</a></div></div>';

            echo '<div class="modal fade" id="' . str_replace(' ', '', get_the_title() ) . 'Modal" tabindex=-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog"><div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            echo '<h4 class="modal-title">' . get_the_title() . '</h4>';
            echo '</div><div class="modal-body">';
            echo '<p>' . get_the_content() . '</p>';
            echo '</div><div class="modal-footer">';
            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            echo '</div></div></div></div>';

            $service_count++;
            if( $service_count == 4 ) {
                echo '</div>';
                $service_count = 0;
            }  
        endwhile;
        echo '</div></section>';
    endif;

$benefits_args = array(
    'post_type' => 'benefits',
    'showposts' => -1,
    'order'     => 'ASC',
);
$benefits_posts = new WP_Query( $benefits_args );

if( $benefits_posts->have_posts() ) {

    echo '<section id="portfolio" class="bg-light-gray" data-echo-background="' . THEME_IMG_URL . '/photo-4.jpg">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-lg-12 text-center">';
    echo '<h2 class="section-heading">Benefits</h2>';
    echo '</div></div>';
    $benefit_count = 0;
    while( $benefits_posts->have_posts() ) : $benefits_posts->the_post();
        if( has_post_thumbnail() ) {
            if( $benefit_count == 0 ) {
                echo '<div class="row">';
            }

            $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID(), 'benefit_size' ), 'benefit_size' );

            echo '<div class="col-md-4 col-sm-6 portfolio-item">';
            echo '<a href="' . get_permalink() . '" class="portfolio-link">';
            echo '<div class="portfolio-hover">';
            echo '<div class="portfolio-hover-content">';
            echo '<i class="fa fa-plus fa-3x"></i>';
            echo '</div></div>';
            // echo get_the_post_thumbnail(get_the_ID(), 'benefit_size');
            echo '<img data-echo="' . $img_src[0] . '" alt=' . get_the_title() . '" title="' . get_the_title() . '">';
            echo '</a>';
            echo '<div class="portfolio-caption">';
            echo '<h4>' . get_the_title() . '</h4>';
            echo '</div></div>';

            $benefit_count++;
            if( $benefit_count == 3 ) {
                echo '</div>';
                $benefit_count = 0;
            }       
        }
    endwhile;

    echo '</div></section>';

}

$client_ids = op_get_option('client_ids');

if( ! empty( $client_ids ) ) {
    echo '<section id="clients">';
    echo '<div class="row"><div class="col-lg-12 text-center">';
    echo '<h2 class="section-heading">Our Clients</h2>';
    echo '<hr class="primary">';
    echo '</div></div>';
    $clients_ids = explode( ';', $client_ids );
    $client_count = 0;
    foreach( $clients_ids as $id ) {
        $generated_id = $id . ';';
        $id = str_replace('id-', '', $id );
        if( ! empty( $id ) ) {
            if( $client_count == 0 ) {
                echo '<div class="row">';
            }
            echo '<div class="col-xs-4"><div class="thumbnail">';
            $image = wp_get_attachment_image_src( $id, 'featured' );
            echo '<img data-echo="' . $image[0] . '">';
            echo '</div></div>';

            $client_count++;
            if( $client_count == 3 ) {
                echo '</div>';
                $client_count = 0;
            }  
        }
    }
    echo '</section>';
}
?>
<section id="more_details">
    <article>
        <h3> Want to know more details ? <a href="<?php echo home_url() . '/details'; ?>"> Get Here </a></h3>
    </article>
</section>
<?php
get_footer();