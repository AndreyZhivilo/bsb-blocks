<?php

function render_2_cols($attributes){
    ob_start()
    ?>
    <section class="simple-cards">
        <div class="simple-cards__row">
            <?php foreach($attributes['posts'] as $post){ ?>
                <div class="simple-cards__column">
                    <a href="<?php echo $post['link']; ?>" class="link-card">
                        <p class="link-card__title"><?php echo $post['title']; ?> 👉</p>
                        <p class="link-card__description"><?php echo $post['description']; ?></p>
                        <p class="link-card__read-more">Читать дальше</p>
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


