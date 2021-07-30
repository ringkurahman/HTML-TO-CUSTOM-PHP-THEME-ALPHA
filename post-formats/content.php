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
