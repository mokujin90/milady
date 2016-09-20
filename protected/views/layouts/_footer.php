<footer class="footer bg-full-width">
    <?if($this->footerContent):?>
    <div class="dark-gray-gradient line top <?if($this->footerContent):?>lazy-content<?endif;?>">
            <?=$this->footerContent;?>
    </div>
    <?endif;?>

    <div class="content">
        <div class="sitemap">
            <?foreach($menu as $item){?><nav class="sitemap-block">
                <p class="sitemap-block__title"><?=$item['name']?></p>
                <nav class="sitemap-links">
                    <?foreach($item['items'] as $link){?>
                        <a class="sitemap-link" href="<?=$link['url']?>"><?=$link['name']?></a>
                    <?}?>
                </nav><!--personal-list-->
                </nav><?}?>
        </div><!--sitemap-->

        <a class="dev-link" href="http://wconsults.ru">
            <span class="dev-link__text">Разработано в</span>
            <i class="dev-link__logo"></i>
        </a>

        <div class="apps">
            <a class="app app_1" href="#"></a>
            <a class="app app_2" href="#"></a>
            <a class="app app_3" href="#"></a>

        </div><!--apps-->

        <div class="f-bottom spacer">
            <ul class="f-contacts">
                <li class="f-contacts-block">
                    <span class="f-contacts__name">Адрес:</span>
                    <span class="f-contacts__desc">125468, г. Москва, Ленинградский пр., 49</span>
                </li>

                <li class="f-contacts-block">
                    <span class="f-contacts__name">Телефон:</span>
                    <span class="f-contacts__desc">+7 (495) 744-34-72</span>
                </li>

                <li class="f-contacts-block">
                    <span class="f-contacts__name">e-mail:</span>
                    <span class="f-contacts__desc">info@iip.ru</span>
                </li>

            </ul>

            <div class="search">
                <input class="search__field" type="text" name="search" placeholder="Поиск"/>
                <span class="search__btn"><i class="icon icon-search"></i></span>
            </div><!--search-->

            <div class="f-bottom-right">
                <div class="social">
                    <a class="social__link social__link_vk" href="#"></a>
                    <a class="social__link social__link_fb" href="#"></a>
                    <a class="social__link social__link_tw" href="#"></a>
                    <a class="social__link social__link_ytb" href="#"></a>
                    <a class="social__link social__link_rss" href="#"></a>
                </div><!--social-->

                <a class="visiters-count" href="#"></a>

            </div><!--f-bottom-right-->

        </div><!--f-bottom-->

    </div><!--content-->

</footer>