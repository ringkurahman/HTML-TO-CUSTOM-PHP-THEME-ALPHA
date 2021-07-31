<?php get_header(); ?>

<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>

<div class="posts">
  <?php

    if( !have_posts() ){
      ?>
        <h4 class="text-center">
          <?php  _e('No Result Found', 'alpha') ?>
        </h4>
      <?php
    }

    while ( have_posts() ) {
      the_post();
      get_template_part("post-formats/content", get_post_format());
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

