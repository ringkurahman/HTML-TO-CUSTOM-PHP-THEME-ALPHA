<?php get_header(); ?>

<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>

<div class="container">
  <div class="authorsection authorpage">
  <div class="row">
    <div class="col-md-3 authorimage">
      <?php
        echo get_avatar(get_the_author_meta("id"));
      ?>
    </div>
    <div class="col-md-9">
      <h4>
        <?php
          echo strtoupper(get_the_author_meta("display_name"));
        ?>
        <p>
        <?php
          echo get_the_author_meta("description");
        ?>
        </p>
      </h4>
    </div>
  </div>
</div>
</div>

<div class="posts text-center">

  <?php
    while ( have_posts() ) {
      the_post();
      ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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

