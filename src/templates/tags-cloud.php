<?php

function render_tags_cloud($attributes){
    ob_start()
    ?>
    <div class="tags-cloud">
        <div class="tags-cloud__row">
            <?php foreach($attributes['tags'] as $tag){ ?>
                <a href="<?php echo $tag['link'];?>" class="tags-cloud__tag single-tag"><?php echo "#" . $tag['label'];?></a>
            <?php }; ?>
        </div>
    </div>
    <?php
    $output = ob_get_contents();
    
    ob_end_clean();    
    
    return $output;
            
}


