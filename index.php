<?php get_header(); ?>

<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>

<div class="posts">
  <?php
    while ( have_posts() ) {
      the_post();
  ?>
    <!-- Post Class -->
    <div class="post" <?php post_class(); ?> >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="post-title">
                      <!-- Post Title -->
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <strong>
                          <!-- Author Name -->
                          <?php the_author(); ?>
                        </strong><br/>
                        <!-- Show Date -->
                        <?php echo get_the_date(); ?>
                    </p>
                    <!-- Show Post Tag -->
                        <?php echo get_the_tag_list("<ul class=\"list-unstyled\">,<li>","</li><li>","</li></ul>"); ?>
                </div>
                <div class="col-md-8">
                    <p>
                      <!-- Show Thumbnail Image -->
                        <?php
                          if(has_post_thumbnail()){
                            // Add thumbnail Size and Image Class
                            the_post_thumbnail("large", array("class" =>"img-fluid"));
                          }
                          // Post Excerpt -->
                          the_excerpt();

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
  }
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

