<?php
//лькість сторінок для відображення на екран
$count_pages = ceil($paginate['all']/$paginate['items']);
$active = $paginate['active'];
$url = $paginate['url'];
$url_page = $paginate['url_page'];

$start = 1;
if($count_pages > 1) {
    $left = $active - 1;
    $right = 5 - $active;
    if ($left < floor(5 / 2)) {$start = 1;}
    else $start = $active - floor(5 / 2);
    $end = $start + 4;
    if ($end > $count_pages) {
        $start -= ($end - $count_pages);
        $end = $count_pages;
        if ($start < 1){
            $start = 1;
        }
    }
}
if($count_pages > 1){
    ?>
    <ul class="pagination">
        <?php
        if ($active != 1) { ?>
            <li><a class="arrow" href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Попередня сторінка">&laquo;</a></li>
            <?php if($active !=2 and $active !=3){ ?>
                <li><a href="<?=$url?>">1</a></li>
                <?php if($active !=4 and $count_pages !=5 and $count_pages !=6){ ?>
                    <li class="disabled"><a href="#">...</a></li>
                <?php } ?>
            <?php }} ?>
        <?php for ($i = $start; $i <= $end; $i++) { ?>
            <?php if ($i == $active) { ?><li class="active"><a href="<?=$url_page.$i?>"><?=$i?><span class="sr-only">(current)</span></a></li><?php } else { ?><li><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a></li><?php } ?>
        <?php } ?>
        <?php if ($active != $count_pages) {
            if($count_pages != 2 and $count_pages != 3  and $count_pages != 4 and $count_pages != 5 and ($count_pages - 1) != $active and ($count_pages - 2) != $active){
                if(($count_pages - 3) != $active and ($count_pages - $active) != 1 and ($count_pages - $active) != 2 and $count_pages !=5 and $count_pages !=6){
                    ?>
                    <li class="disabled"><a href="#">...</a></li>
                <?php } ?>
                <li><a href="<?=$url_page.$count_pages?>"><?=$count_pages;?></a></li>
                <?php
            }
            ?>
            <li><a class="arrow" href="<?=$url_page.($active + 1)?>" title="Наступна сторінка">&raquo;</a></li>

        <?php } ?>
    </ul>
<?php } ?>