<?php

function render_hosting_block($attributes){ 
    
    $args = [
        'post_type'      => $attributes['postType'],
        'posts_per_page' => 1,
        'post_name__in'  => [$attributes['slug']],
        'fields'         => 'ids',
        'post_status' => 'any',   
       
    ];
    $q = get_posts( $args );

    $id = $q[0]? $q[0] : 0;

    $name = get_field('hosting_name', $id)? get_field('hosting_name', $id): ''; 
    $picture = get_field('hosting_picture', $id)? get_field('hosting_picture', $id) : '';
    $reiting = get_field('hosting_my_reiting', $id)? number_format(get_field('hosting_my_reiting', $id), 1, '.') : '';
    $link = get_field('hosting_link', $id)? get_field('hosting_link', $id) : '';
    $visible_link = get_field('hosting_visible_link', $id)? get_field('hosting_visible_link', $id) : '';
    $test = get_field('hosting_test', $id)? get_field('hosting_test', $id) : '';
    $price = get_field('hosting_price', $id)? get_field('hosting_price', $id) : '';
    $support = get_field('hosting_support', $id)? get_field('hosting_support', $id): '';
    $panel = get_field('hosting_panel', $id)? get_field('hosting_panel', $id) : '';
    $locations = get_field('hosting_locations', $id)? get_field('hosting_locations', $id): '';

    ob_start()
    ?>
    <?php if($attributes['anchor']){ ?>
        <a name="<?php echo $attributes['anchor'];?>"></a>                            
    <?php };?>
    <?php if($attributes['title']){ ?>
        <h2><?php echo $attributes['title'];?></h2>                            
    <?php };?>
    <section class="hosting-info">    
        <div class="hosting-info__title"><?php echo $name; ?></div>
        <div class="hosting-info__row">
            <div class="hosting-info__side">
                <div class="hosting-info__picture">
                    <img src="<?php echo $picture;?>" alt="">
                </div>
                <div class="hosting-info__rating host-rating">
                    <div class="host-rating__title">Мой рейтинг:</div>
                    <div class="host-rating__value">
                        <img class="host-rating__icon" src="<?php echo plugins_url(). '/my-blocks/icons/star.svg'; ?>" alt="">
                        <?php echo $reiting ;?><span>&nbsp;/5</span>
                    </div>
                </div>
            </div>
            <div class="hosting-info__body">
                <div class="hosting-info__table hosting-table">
                    <table>
                        <tbody>
                            <tr>
                                <td>Сайт:</td>
                                <td>
                                    <a class="hosting-info__link" href="<?php echo $link ;?>"><?php echo $visible_link;?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Тестовый период:</td>
                                <td><?php echo $test; ?></td>
                            </tr>
                            <tr>
                                <td>Самый дешевый тариф:</td>
                                <td><?php echo $price; ?></td>
                            </tr>
                            <tr>
                                <td>Техподдержка:</td>
                                <td><?php echo $support; ?></td>
                            </tr>
                            <tr>
                                <td>Панель управления:</td>
                                <td><?php echo $panel; ?></td>
                            </tr>
                            <tr>
                                <td>Дата центры:</td>
                                <td><?php echo $locations; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <div class="hosting-info__btns buttons-group">
                    <?php if($attributes['isInternalLinkVisible']){ ?>
                        <a class="buttons-group__internal internal-btn" href="<?php echo $attributes['internalLink']; ?>">Читать обзор</a>                            
                    <?php };?>
                    <a class="buttons-group__external external-btn" href="<?php echo $link ;?>">Перейти на сайт</a>
                </div>
            </div>
        </div>
                
    </section>
    
   
   <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
}