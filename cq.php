<?php
/**
 * Template Name: Custom Query
 */
?>

<?php get_header(); ?>

<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>

<div class="container">
          <div class="posts text-center">
            <?php
            $paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
            $posts_per_page = 3;
            $post_ids       = array( 1, 33, 43, 56, 36,25,20 );
            $_p             = get_posts( array(
                'posts_per_page' => $posts_per_page,
                'post__in'       => $post_ids,
                'orderby'        => 'post__in',
                'paged'          => $paged
            ) );
            foreach ( $_p as $post ) {
                setup_postdata( $post );
                ?>
                <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2></a>
                    <?php the_post_thumbnail( "large", array( "class" => "img-fluid" ) ); ?>
                    <?php the_excerpt(); ?>
                  </div>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
          </div>

        <div class="container post-pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <?php
                    echo paginate_links( array(
                        'total' => ceil( count( $post_ids ) / $posts_per_page )
                    ) );
                    ?>
                </div>
            </div>
        </div>

    </div>

<?php get_footer(); ?>

