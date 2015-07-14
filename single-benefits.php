<?php
/**
 * Benefits post template.
 */
get_header(); 

$current_page_id = get_the_ID();
?>

<div class="site-inner">
    <div class="content">
        <article class="inner-content entry" style="width:100%;">

        	<?php 
        	while( have_posts() ) : the_post();

        		echo '<div class="heading">';
        		echo '<h3>' . get_the_title() . '</h3>';
        		echo '</div>';

                $current_page_id = get_the_ID();
        		if( has_post_thumbnail() ) {
        			echo '<figure>';
        			echo get_the_post_thumbnail(get_the_ID(), 'benefit_size');
        			echo '</figure>';
        		}
        		echo '<div class="inner-post-content">';
        		echo the_content();
        		echo '</div>';
        	endwhile;
        	?>
        </article>

        <div class="sidebar-box polygon">
            <ul class="polygon__content">
                <?php
                    $benefits_args = array(
                    'post_type' => 'benefits',
                    'showposts' => -1,
                    'order'     => 'ASC',
                );
                $benefits_posts = new WP_Query( $benefits_args );

                if( $benefits_posts->have_posts() ) {
                    while( $benefits_posts->have_posts() ) : $benefits_posts->the_post();

                        $current_class = '';
                        if( $current_page_id == get_the_ID() ) {
                            $current_class = 'current';
                        }
                        echo '<li><a class="' . $current_class . '" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                    endwhile;
                }

                ?>
            </ul>
        </div>
    </div>
</div>

<?php
get_footer();