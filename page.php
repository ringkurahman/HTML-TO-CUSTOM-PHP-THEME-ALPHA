
<?php get_header(); ?>

<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>


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
                        <p class="text-center">
                            <em><?php the_author(); ?></em><br/>
                            <?php echo get_the_date(); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="slider">
                            <?php
                                if ( class_exists( 'Attachments' ) ) {
                                    $attachments = new Attachments( 'slider' );
                                    if ( $attachments->exist() ) {
                                        while ( $attachment = $attachments->get() ) { ?>
                                            <div>
                                                <?php echo $attachments->image( 'large' ); ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div>
                        <!-- Show Thumbnail Image -->
                            <?php
                                if ( !class_exists( 'Attachments' ) ) {
                                    if ( has_post_thumbnail() ) {
                                        $thumbnail_url = get_the_post_thumbnail_url( null, "large" );
                                        printf( '<a class="popup" href="%s" data-featherlight="image">', $thumbnail_url );
                                        the_post_thumbnail( "large", array( "class" => "img-fluid" ) );
                                        echo '</a>';
                                    }
                                }

                                //-- Post Description -->
                                the_content();
                                // One Page/Post Pagination -->
                                wp_link_pages();
                                // Post Pagination -->
                                next_post_link();
                                echo "<br/>";
                                previous_post_link();

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
            <!-- Post Pagination -->
            <?php
              the_posts_pagination(array(
                "screen_reader_text" => ' ',
                "prev_text" => "New Posts",
                "next_text" => "Old Posts"
              ));
            ?>
          </div>
        </div>
      </div>
      </div>


<?php get_footer(); ?>

