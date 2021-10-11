<?php

function render_3_cols($attributes){
    ob_start()
    ?>
    <section class="img-cards">
        <div class="img-cards__row">
            <?php foreach($attributes['posts'] as $post){ ?>
                <div class="img-cards__column">
                    <a href="<?php echo $post['link']; ?>" class="link-card-img">
                        <div class="link-card-img__picture">
                            <img src="<?php echo $post['picture']; ?>" width=265 height=177 alt="">
                        </div>
                        <div class="link-card-img__body">
                            <p class="link-card-img__title"><?php echo $post['title']; ?></p>
                            <p class="link-card-img__description"><?php echo $post['description']; ?></p>
                            <p class="link-card-img__read-more">
                                <img src="<?php echo plugins_url(). '/my-blocks/icons/right-arrow.svg'; ?>" alt="">
                            </p>
                            
                        </div>
                    </a>
                </div>
            <?php }; ?>
        </div>        
    </section>
    <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
            
}


