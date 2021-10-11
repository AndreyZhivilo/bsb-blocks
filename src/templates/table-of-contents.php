<?php

function render_contents_table($attributes){
    ob_start()
    ?>
    <section class="contents-table">
        <div class="contents-table__title">
            Содержание:
        </div>
        <div class="contents-table__row">
            <a href="#description" class="contents-table__item">
                <img class="contents-table__icon" src="<?php echo plugins_url(). '/my-blocks/icons/description.svg'; ?>" alt="">
                <span>Описание</span>
            </a>
            <a href="#panel" class="contents-table__item">
                <img class="contents-table__icon" src="<?php echo plugins_url(). '/my-blocks/icons/panel.svg'; ?>" alt="">
                <span>Панель</span>
            </a>
            <a href="#prices" class="contents-table__item">
                <img class="contents-table__icon" src="<?php echo plugins_url(). '/my-blocks/icons/dollar.svg'; ?>" alt="">
                <span>Тарифы</span>
            </a>
            <a href="#reviews" class="contents-table__item">
                <img class="contents-table__icon" src="<?php echo plugins_url(). '/my-blocks/icons/reviews.svg'; ?>" alt="">
                <span>Отзывы</span>
            </a>
        </div>
             
    </section>
    <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
            
}


