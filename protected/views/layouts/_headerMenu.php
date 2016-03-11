<ul class="page-nav">
    <?foreach($menu as $item){?><li>
        <a class="page-nav__link" href="#"><?=$item['name']?></a>
        <div class="page-nav-sec">
            <?foreach($item['items'] as $link){?>
                <a class="page-nav-sec__link" href="<?=$link['url']?>"><?=$link['name']?></a>
            <?}?>
        </div><!--personal-list-->
        </li><?}?>
</ul>
