<!-- *** Footer Starts *** -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="footer-first footer-columns">
                    <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
                        <?php dynamic_sidebar('first-footer-widget-area'); ?>
                    <?php else : ?>
                        <h4><?php _e('About Us', 'start-point'); ?></h4>
                        <p>
                           <?php _e('We make simple and easy to use WordPress themes. This will help you to make your website easily.', 'start-point'); ?> 
                        </p>
                        <p>
                            <?php _e('You just need to simply install the theme and your website will be ready within few minutes.', 'start-point'); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-second footer-columns">
                    <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
                        <?php dynamic_sidebar('second-footer-widget-area'); ?>
                    <?php else : ?> 
                        <h4><?php _e('Archives Widget', 'start-point'); ?></h4>
                        <?php _e(' <ul>
                            <li><a href="#">January 2010</a></li>
                            <li><a href="#">December 2009</a></li>
                            <li><a href="#">November 2009</a></li>
                            <li><a href="#">October 2009</a></li>
                        </ul>', 'start-point'); ?>
                       
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-third footer-columns">
                <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
                    <?php dynamic_sidebar('third-footer-widget-area'); ?>
                <?php else : ?>
                    <h4><?php _e('Recent Posts', 'start-point'); ?></h4>
                    <?php _e('<ul>
                        <li>The Sigma Style And Looks</li>
                        <li>Fashion Is Not Over-Confidence</li>
                        <li>Spring Wear, Morning, Noon Fashion</li>
                        <li>Fashion Is Not A Show Off</li>
                    </ul>', 'start-point'); ?>
                    
                <?php endif; ?>					
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-fourth footer-columns">
                <?php if (is_active_sidebar('fourth-footer-widget-area')) : ?>
                    <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
                <?php else : ?>
                    <h4><?php _e('Any Queries', 'start-point'); ?></h4>
                    <p><?php _e('If you have any queries regarding the theme or need any help you can contact us at inkthemes@gmail.com.', 'start-point'); ?></p>
                    <p><?php _e('Feel free to ask anything. We will provide you the best support.', 'start-point'); ?></p>
                    <form role="search" method="get" class="searchform" action="#">
                        <div>
                            <input type="text" placeholder="Search" name="s" id="search">
                            <input type="submit" id="searchsubmit" value="Search">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
</div>
<!-- *** Footer Ends *** -->