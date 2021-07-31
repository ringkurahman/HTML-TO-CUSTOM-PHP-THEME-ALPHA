<?php
$alpha_layout_class = "col-md-8";
$alpha_text_class   = "";
if ( ! is_active_sidebar( "sidebar-1" ) ) {
    $alpha_layout_class = "col-md-10 offset-md-1";
    $alpha_text_class   = "text-center";
}
?>

<?php get_header(); ?>
<body <?php body_class( array( "first_class", "second_class" ) ); ?>>
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>
    <div class="container">
        <div class="row">
            <div class="<?php echo $alpha_layout_class; ?>">
                <div class="posts" <?php ?>>
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <div <?php post_class( array( "first_class", "second_class" ) ); ?>>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="post-title <?php echo $alpha_text_class; ?>">
                                        <!-- Post Title -->
                                            <?php the_title(); ?>
                                        </h2>
                                        <p class="<?php echo $alpha_text_class; ?>">
                                        <!-- Author Name with Link -->
                                            <em><?php the_author_posts_link(); ?></em><br/>
                                            <!-- Show Date -->
                                            <?php echo get_the_date(); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
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

                                    <!-- Author Section -->
                                    <div class="authorsection">
                                        <div class="row">
                                            <div class="col-md-2 authorimage">
                                                <?php
                                                echo get_avatar( get_the_author_meta( "ID" ) );
                                                ?>
                                            </div>
                                            <div class="col-md-10">
                                                <h4>
                                                    <?php echo get_the_author_meta( "display_name" ); ?>
                                                </h4>
                                                <p>
                                                    <?php echo get_the_author_meta( "description" ); ?>
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Post Comments -->
                                    <?php if ( comments_open() ): ?>
                                        <div class="col-md-12">
                                            <?php
                                            //comments_template();
                                            ?>
                                        </div>
                                    <?php endif; ?>
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
            </div>

            <!-- Right Sidebar -->
            <?php
            if ( is_active_sidebar( "sidebar-1" ) ):
                ?>
                <div class="col-md-4">
                    <?php
                    if ( is_active_sidebar( "sidebar-1" ) ) {
                        dynamic_sidebar( "sidebar-1" );
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>
