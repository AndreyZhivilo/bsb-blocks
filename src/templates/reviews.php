<?php

function render_client_reviews($attributes){
    ob_start()
    ?>
    <div class="reviews-dashboard">
        <div class="reviews-dashboard__row">
            <div class="reviews-dashboard__title">
                Оценка пользователей:
            </div>
            <div class="reviews-dashboard__grade">
                <img class="reviews-dashboard__icon" src="<?php echo plugins_url(). '/my-blocks/icons/rating.svg'; ?>" alt="">
                <div class="reviews-dashboard__mark">
                    <?php echo do_shortcode("[show-average-rating taxonomy='{current_page_id}' orderby='menu_order' order='ASC' theme='none' stars_label='Rating of ' average='on' total_label=' on a total of ' total_label_after=' Ratings' total_label_after_singular=' Rating' empty='0' ]"); ?>
                </div>
                <span class="reviews-dashboard__scale">&nbsp;/5</span>
            </div>
            <div class="reviews-dashboard__info">
                <div class="reviews-dashboard__stars star-rating">
                    <?php echo do_shortcode("[show-average-rating taxonomy='{current_page_id}' orderby='menu_order' order='ASC' theme='big_star_box' stars='on' half_stars='on' average_label=' Average of ' empty='0' ]"); ?>
                </div>
                <div class="reviews-dashboard__count">
                    На основании&nbsp;<span><?php echo do_shortcode("[show-average-rating taxonomy='{current_page_id}' orderby='menu_order' order='ASC' theme='none' stars_label='Rating of ' average_label=' Average of ' total='on' empty='0' ]") ; ?></span>&nbsp;отзывов
                </div>
            </div>
        </div>    
    </div>    
    <div class="reviews-text">
        <?php echo do_shortcode("[show-testimonials taxonomy='{current_page_id}' orderby='date' order='ASC' limit='10' layout='grid' options='theme:speech,info-position:info-below,text-alignment:left,columns:1,filter:none,rating:on,quote-content:short,charlimitextra:(...),image-size:ttshowcase_small,image-shape:circle,image-effect:none,image-link:on']"); ?>
        <?php echo do_shortcode("[show-testimonials-form rating='hover' email='on' verification='on' taxonomy='{current_page_id}' style='none' ]"); ?>
    </div>
    
             
    
    <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
            
}


