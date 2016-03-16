<?php $this->beginContent('//layouts/main'); ?>
    <?php echo $content; ?>
<?if(!Yii::app()->user->isGuest){?>
    </section><!--services-->
    <section class="services bg-full-width">
        <div class="content">
            <h2 class="services__title">
                <i class="icon icon-services-title"></i>
                <span>Услуги портала</span>
            </h2>

            <div class="services-col services-col_1">
                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-1"></i>
                </span>

                    <span class="service__name">Проверка компании</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'checkConsultation', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>


                </div><!--service-->

                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-2"></i>
                </span>

                    <span class="service__name">Маршрутная карта</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'mapConsultation', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>


                </div><!--service-->

                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-3"></i>
                </span>

                    <span class="service__name">Предложения по кредитам</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'creditConsultation', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>


                </div><!--service-->

            </div><!--services-col-->

            <div class="services-col">
                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-4"></i>
                </span>

                    <span class="service__name">Анализ проекта</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'projectAnalyse', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>


                </div><!--service-->

                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-5"></i>
                </span>

                    <span class="service__name">Сопровождение сделки</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'transactionSupport', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>

                </div><!--service-->

                <div class="service">
                <span class="service__icon-wrap">
                    <i class="icon icon-service-6"></i>
                </span>

                    <span class="service__name">Расчет рентабельности</span>

                    <a class="service__btn" href="<?=$this->createUrl('message/create', array('system' => 'profitabilityConsultation', 'project_id' => $this->project->id))?>">ЗАКАЗАТЬ УСЛУГУ</a>

                </div><!--service-->

            </div><!--services-col-->

        </div><!--content-->

<?}?>
<?php $this->endContent(); ?>