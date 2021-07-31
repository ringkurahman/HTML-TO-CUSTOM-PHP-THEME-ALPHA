<?php
/*
 * Template Name: Testimonial Page Template
 */
get_header();
?>
<body <?php body_class(); ?>>
<?php get_template_part( "/template-parts/about-page-part/hero-page" ); ?>

<div class="posts">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <div class="post" <?php post_class(); ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h2 class="post-title text-center">
                            <?php the_title(); ?>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="testimonials slider text-center">
                            <?php
                            if ( class_exists( 'Attachments' ) ) {
                                $attachments = new Attachments( 'testimonials' );
                                if ( $attachments->exist() ) {
                                        while ( $attachment = $attachments->get() ) { ?>
                                        <div>
                                            <?php echo $attachments->image( 'thumbnail' ); ?>
                                            <h4><?php echo esc_html($attachments->field( 'name' )); ?></h4>
                                            <p><?php echo esc_html($attachments->field( 'testimonial' )); ?></p>
                                            <p>
                                                <?php echo esc_html($attachments->field( 'position' )); ?>
                                                <strong>
                                                    <?php echo esc_html($attachments->field( 'company' )); ?>
                                                </strong>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    ?>

    <div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                the_posts_pagination( array(
                    "screen_reader_text" => ' ',
                    "prev_text"          => "New Posts",
                    "next_text"          => "Old Posts"
                ) );
                ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
