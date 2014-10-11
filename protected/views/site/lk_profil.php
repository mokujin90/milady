<style>
    .red-box {
        background: #F00;
        font-size: 12px;
        line-height: 20px;
        width: 120px;
    }
</style>
<div id="general">
    <div class="content columns">
        <div class="side-column opacity-box">
            <img class="profile-image" src="/images/assets/avatar.png">
            <div class="profile-text">ООО ЦВЕТМЕТ</div>
            <div class="load-action">загрузить логотип</div>
            <div class="profile-name">ИНИЦИАТОР</div>
        </div>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <div class="row">
                    <div class="red-box">ИНИЦИАТОР</div>
                </div>
                <div class="row">
                    <?=CHtml::label('описание компании', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'big-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('ФИО', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('телефон', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('должность', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('e-mail', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row extra-margin">
                    <?=CHtml::label('какие регионы интересны', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'middle-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="row extra-margin">
                    <?=CHtml::label('какие организации интересны', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'middle-textarea', 'placeholder' => 'Текст'))?>
                </div>
            </div>
            <div class="inner-column">
                <h2>сведенья об организации</h2>
                <div class="row">
                    <?=CHtml::label('форма', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('наименование', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('инн', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('огрн', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('название', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
                <div class="row">
                    <?=CHtml::label('название', 'description')?>
                    <?=CHtml::textField('description', '', array('placeholder' => 'Текст'))?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>