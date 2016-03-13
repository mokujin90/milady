<div class="page-wrap">
    <div class="page-wrap-left">
        <div class="aside-block about-us-pages">
            <?if (isset($_GET['page'])) {
                echo CHtml::link('О портале', array('site/aboutus'), array('class' => "about-us-page__link"));
            } else {
                echo CHtml::tag('p', array('class' => "about-us-page__active"), 'О портале');
            }
            foreach ($pages as $object) {
                if ($model = Content::model()->findByPk($object->object_id)) {
                    if (isset($_GET['page']) && $_GET['page'] == $model->url) {
                        echo CHtml::tag('p', array('class' => "about-us-page__active"), $model->name);
                    } else {
                        echo CHtml::link($model->name, array('site/content', 'page' => $model->url), array('class' => "about-us-page__link"));
                    }
                }
            }?>
        </div><!--aside-block-->

        <div class="aside-block registration">
            <input class="registration__field" type="text" name="registration" placeholder="введите e-mail"/>
            <button class="blue-btn registration__btn">Зарегистрироваться</button>
            <p class="registration__desc">
                Зарегистрируйтесь! <br/>
                Вам будет предоставлена возможность получать
                самые актуальные данные инвест-проектов региона.
            </p>

        </div><!--aside-block-->

    </div><!--page-wrap-left-->

    <div class="page-wrap-right about-us clear-fix">
        <h2 class="about-us__title"><?=$content->name?></h2>
        <?=$content->content?>
        <!--p class="about-us__desc">
            Возможный текст о портале или чего-то еще важное. <br/>
            Существуют две основные трактовки понятия «текст»:
            «имманентная» (расширенная, философски нагруженная) и
            «репрезентативная» (более частная). Имманентный подход подразумевает
            отношение к тексту как к автономной реальности, нацеленность на
            выявление его внутренней структуры. Репрезентативный — рассмотрение
            текста как особой формы представления
            знаний о внешней тексту действительности.
        </p-->


        <div class="page-social">
            <a class="page-social__link page-social__link_vk" href="#">
                <i class="page-social__icon page-social__icon_vk"></i>
                <span class="page-social__count">100</span>
            </a>

            <a class="page-social__link page-social__link_fb" href="#">
                <i class="page-social__icon page-social__icon_fb"></i>
                <span class="page-social__count">100</span>
            </a>

            <a class="page-social__link page-social__link_in" href="#">
                <i class="page-social__icon page-social__icon_in"></i>
                <span class="page-social__count">100</span>
            </a>

        </div><!--page-social-->

    </div><!--page-wrap-right-->

</div><!--page-wrap-->