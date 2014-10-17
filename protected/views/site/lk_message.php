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
                    <a href="#"><i class="icon icon-inbox"></i>Входящие</a>
                    <div class="new-count icon icon-blue-circle">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-write"></i>Написать</a>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-outbox"></i>Отправленные</a>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-project-message"></i>Проекты</a>
                    <div class="new-count icon icon-blue-circle">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-trash"></i>Корзина</a>
                </div>
            </div>
        </div>
        <div class="main-column opacity-box">
            <div class="full-column">
                <div class="row">
                    <?=CHtml::label('От кого', 'description')?>
                    <div class="user-value">Иван Иванович</div>
                </div>
                <div class="row">
                    <?=CHtml::textArea('description', '', array('class' => 'message-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="row extra-margin">
                    <?=CHtml::label('Ответить', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'reply-message-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="button-panel">
                    <div class="attach-wrap">
                        <div class="attach-btn icon icon-attach"></div>
                        <div class="attach-menu">
                            <div class="attach-action foto-action"><i class="icon icon-photo"></i>Фото</div>
                            <div class="attach-action doc-action"><i class="icon icon-file"></i>Документ</div>
                        </div>
                    </div>
                    <a href="#" class="btn pull-right">отправить</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
    $('.attach-btn').click(function () {
        $(this).closest('.attach-wrap').toggleClass('active');
    });
</script>