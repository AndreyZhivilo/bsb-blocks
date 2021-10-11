<?php

function render_pros_cons($attributes){
    ob_start()
    ?>
    <section class="pros-cons">
        <div class="pros-cons__row">
            <div class="pros-cons__pros pros">
                <div class="pros-cons__title pros__title">Понравилось</div>
                <ul class="pros__items">    
                    <?php foreach($attributes['pros'] as $pros){ ?>
                        <li class="pros__item"><?php echo $pros;?></li>
                    <?php } ?>                
                </ul>
            </div>
            <div class="pros-cons__cons cons">
                <div class="pros-cons__title cons__title">Не понравилось</div>
                <ul class="cons__items">    
                    <?php foreach($attributes['cons'] as $cons){ ?>
                        <li class="cons__item"><?php echo $cons;?></li>
                    <?php } ?>                
                </ul>
            </div>
        </div>
             
    </section>
    <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
            
}


