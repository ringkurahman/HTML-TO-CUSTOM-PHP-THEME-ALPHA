<?php
  get_header();
?>
<!-- Body Classes -->
<body <?php body_class(); ?> >
<!-- Hero Section -->
<?php get_template_part("/template-parts/common-part/hero"); ?>

<div class="container error-view">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">
        <?php
          _e("Sorry we couldn't find what you were looking for","alpha");
        ?>
      </h1>
    </div>
  </div>
</div>

</body>


<?php
  get_footer();
?>
