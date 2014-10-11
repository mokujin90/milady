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
            <h1>Мои сообщения</h1>
            <div class="side-menu-list">
                <div class="side-menu-item">
                    <a href="#" class="inbox-icon">Входящие</a>
                    <div class="new-count">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#" class="write-icon">Написать</a>
                </div>
                <div class="side-menu-item">
                    <a href="#" class="send-icon">Отправленные</a>
                </div>
                <div class="side-menu-item">
                    <a href="#" class="project-icon">Проекты</a>
                    <div class="new-count">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#" class="trash-icon">Корзина</a>
                </div>
            </div>
        </div>
        <div class="main-column opacity-box">
            <div class="full-column">
                <div class="row">
                    <?=CHtml::label('От кого', 'description')?>
                    <div class="text-value">Иван Иванович</div>
                </div>
                <div class="row">
                    <?=CHtml::label('описание компании', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'message-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="row extra-margin">
                    <?=CHtml::label('Ответить', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'middle-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="button-panel">
                    <div class="attach-wrap">
                        <div class="attach-btn"></div>
                        <div class="attach-menu">
                            <div class="attach-action foto-action">Фото</div>
                            <div class="attach-action doc-action">Документ</div>
                        </div>
                    </div>
                    <a href="#" class="red-btn pull-right">отправить</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>