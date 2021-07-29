
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Footer Left -->
                <?php
                    if(is_active_sidebar("footer-left")){
                    dynamic_sidebar("footer-left");
                    }
                ?>
            </div>
            <div class="col-md-4">
                <!-- Footer Right -->
                <?php
                    if(is_active_sidebar("footer-right")){
                    dynamic_sidebar("footer-right");
                    }
                ?>

                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footermenu',
                            'menu_id' => 'footermenucontainer',
                            'menu_class' => 'list-inline',
                            )
                        );
                    ?>

            </div>

            <div class="col-md-4">
                <!-- Footer Right -->
                <?php
                    if(is_active_sidebar("footer-center")){
                    dynamic_sidebar("footer-center");
                    }
                ?>

                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'socialmenu',
                            'menu_id' => 'socialmenucontainer',
                            'menu_class' => 'list-inline',
                            )
                        );
                    ?>

            </div>

        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
