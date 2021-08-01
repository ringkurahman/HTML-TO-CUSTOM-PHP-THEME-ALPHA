<?php

require_once get_theme_file_path( '/inc/tgm.php' );

// Conditionally Attachments Plugin File Load
if ( class_exists( 'Attachments' ) ){
  require_once "lib/attachments.php";
}


// For Development Prevent Caching
if ( site_url() == "http://webdevone.local/" ) {
    define( "VERSION", time() );
} else {
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}


// Basic configuration for Theme
function alpha_bootstrapping(){
  load_theme_textdomain("alpha");

  $alpha_custom_logo_details = array(
    'width' =>'100px',
    'height' =>'100px'
  );
  add_theme_support("custom-logo", $alpha_custom_logo_details);

  add_theme_support("custom-background");
  add_theme_support("post-thumbnails");
  add_theme_support("title-tag");
  add_theme_support( 'html5', array( 'search-form' ) );

  $alpha_custom_header_details = array(
    'header-text' => true,
    'default-text-color' => '#222',
    'width' => 1200,
    'height' => 600,
    'flex-height' => true,
  );
  add_theme_support("custom-header", $alpha_custom_header_details);

  add_theme_support("post-formats", array("image","quote", "video", "audio", "chat", "link"));

  add_image_size("alpha-square",400,400,true); //center center
  add_image_size("alpha-square-new1",401,401,array("left","top"));
  add_image_size("alpha-square-new2",500,500,array("center","center"));
  add_image_size("alpha-square-new3",600,600,array("right","center"));

  register_nav_menu("topmenu",__("Top Menu","alpha"));
  register_nav_menu("footermenu",__("Footer Menu","alpha"));
  register_nav_menu("socialmenu",__("Social Menu","alpha"));
  register_nav_menu("sidebarmenu",__("Sidebar Menu","alpha"));
}
add_action("after_setup_theme", "alpha_bootstrapping");


// Load style and script files for post/page
function alpha_assets(){
  wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
  wp_enqueue_style( "featherlight-css", "//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" );
  wp_enqueue_style( "dashicons");
  wp_enqueue_style("tns-style", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css");
  wp_enqueue_style("alpha", get_stylesheet_uri(), null, VERSION);

  wp_enqueue_script( "tns-js", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, "0.0.1", true );
  wp_enqueue_script( "featherlight-js", "//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js", array( "jquery" ), "0.0.1", true );
  wp_enqueue_script( "alpha-main2", get_theme_file_uri( "/assets/js/main.js" ), array(
        "jquery",
        "featherlight-js"
    ), VERSION, true );

}
add_action("wp_enqueue_scripts", "alpha_assets");


// Sidebar Widget Function Register
function alpha_sidebar(){
  register_sidebar(
    array(
      'name' => __( 'Default Sidebar','alpha' ),
      'id' => 'sidebar-1',
      'description' => __( 'Right Sidebar','alpha' ),
      'before_widget' => '<section id="%1&s" class="widget %2&s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>'
    )
  );
  register_sidebar(
    array(
      'name' => __( 'Footer Left','alpha' ),
      'id' => 'footer-left',
      'description' => __( 'Bottom Footer Left','alpha' ),
      'before_widget' => '<section id="%1&s" class="widget %2&s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>'
    )
  );
  register_sidebar(
    array(
      'name' => __( 'Footer Center','alpha' ),
      'id' => 'footer-center',
      'description' => __( 'Bottom Footer Center','alpha' ),
      'before_widget' => '<section id="%1&s" class="widget %2&s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>'
    )
  );
  register_sidebar(
    array(
      'name' => __( 'Footer Right','alpha' ),
      'id' => 'footer-right',
      'description' => __( 'Bottom Footer Right','alpha' ),
      'before_widget' => '<section id="%1&s" class="widget %2&s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>'
    )
  );
}
add_action("widgets_init","alpha_sidebar");


// Password Protected Post Register
function alpha_the_excerpt($excerpt){
  if(!post_password_required()){
    return $excerpt;
  }else {
    echo get_the_password_form();
  }
}
add_filter("the_excerpt","alpha_the_excerpt");

function alpha_protected_title_change(){
  return "%s";
}
add_filter("protected_title_format","alpha_protected_title_change");


// Top Menu List Item Class Add
function alpha_menu_item_class($classes, $item, $args){
  if ( 'topmenu' === $args->theme_location ) {
        $classes[] = 'list-inline-item';
    }
  return $classes;
}
add_filter("nav_menu_css_class","alpha_menu_item_class", 10, 3);


// Footer Menu List Item Class Add
function alpha_menu_footer_class($classes, $item, $args){
  if ( 'socialmenu' === $args->theme_location ) {
        $classes[] = 'list-inline-item';
    }
  return $classes;
}
add_filter("nav_menu_css_class","alpha_menu_footer_class", 10, 3);


// Load About page Background Image on Head
function alpha_about_page_template_background(){
  if ( is_page() ) {
            $alpha_feat_image = get_the_post_thumbnail_url( null, "large" );
            ?>
            <style>
                .page-header {
                    background-image: url(<?php echo $alpha_feat_image;?>);
                }
            </style>
            <?php
        }
  if ( is_front_page() ) {
            if ( current_theme_supports( "custom-header" ) ) {
                ?>
                <style>
                    .header {
                        background-image: url(<?php header_image();?>);
                        background-size: cover;
                        margin-bottom: 50px;
                    }

                    .header h1.heading a, h3.tagline {
                        color: #<?php echo get_header_textcolor();?>;

                    <?php
                    if(!display_header_text()){
                        echo "display: none;";
                    }
                    ?>
                    }

                </style>
                <?php
            }
        }
}
add_action("wp_head","alpha_about_page_template_background", 11);


// Remove Body Classes from the HTML
function alpha_body_class($classes){
  unset($classes[array_search("custom-background-1", $classes)]);
  unset($classes[array_search("custom-background-2", $classes)]);
  return $classes;
}
add_filter("body_class", "alpha_body_class");

// Remove Post Classes from the HTML
function alpha_post_class($classes){
  unset($classes[array_search("custom-background-1", $classes)]);
  unset($classes[array_search("custom-background-2", $classes)]);
  return $classes;
}
add_filter("post_class", "alpha_post_class");


// highlight Search Result
function alpha_highlight_search_results($text){
    if(is_search()){
        $pattern = '/('. join('|', explode(' ', get_search_query())).')/i';
        $text = preg_replace($pattern, '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'alpha_highlight_search_results');
add_filter('the_excerpt', 'alpha_highlight_search_results');
add_filter('the_title', 'alpha_highlight_search_results');


//function alpha_image_srcset(){
//    return null;
//}
//add_filter("wp_calculate_image_srcset","alpha_image_srcset");
add_filter("wp_calculate_image_srcset","__return_null");


// Modify WordPress Default Query
function alpha_modify_main_query($wpq){
  if( is_home() && $wpq->is_main_query() ){
    // Remove Post By ID
      $wpq->set("post__not_in", array(33));
      // Remove Post By Tag ID
      $wpq->set("tag__not_in", array(13));
      // Remove Post By Category ID
      $wpq->set("category__not_in", array(13));
  }
}
add_action("pre_get_posts","alpha_modify_main_query");


