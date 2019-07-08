<?php

/**
 * @var \yii\web\View $this
 * @var \yii\mail\BaseMessage $content
 */

use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <?= Html::beginTag(
        'html',
        [
            'xmlns' => 'http://www.w3.org/1999/xhtml',
            'style' => 'font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; font-size: 100%;' .
                       'line-height: 1.6; margin: 0; padding: 0;'
        ]
    ) ?>
        <?= Html::beginTag('head') ?>
            <?= Html::tag('meta', '', ['name' => 'viewport', 'content' => 'width=device-width']) ?>
            <?= Html::tag(
                'meta',
                ['http-equiv' => 'Content-Type', 'content' => 'text/html; charset=' . \Yii::$app->charset]
            ) ?>
            <?php $this->head() ?>
        <?= Html::endTag('head') ?>
        <?= Html::beginTag('body', ['class' => 'mailer-html-body']) ?>
            <?= Html::beginTag('table', ['class' => 'body-wrap mailer-html-table']) ?>
                <?= Html::beginTag('tr', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::endTag('td') ?>
                    <?= Html::beginTag('td', ['class' => 'container mailer-html-table-content-container']) ?>
                        <?= Html::beginTag('div', ['class' => 'content mailer-html-div-content']) ?>
                            <?= Html::beginTag('table', ['class' => 'mailer-html-table1']) ?>
                                <?= Html::beginTag('tr', ['class' => 'mailer-html-table-content']) ?>
                                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                                        <?php $this->beginBody() ?>
                                            <?= $content ?>
                                        <?php $this->endBody() ?>
                                    <?= Html::endTag('td') ?>
                                <?= Html::endTag('tr') ?>
                            <?= Html::endTag('table') ?>
                        <?= Html::endTag('div') ?>
                    <?= Html::endTag('td') ?>
                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::endTag('td') ?>
                <?= Html::endTag('tr') ?>
            <?= Html::endTag('table') ?>
            <?= Html::beginTag('table', ['class' => 'footer-wrap mailer-html-table2']) ?>
                <?= Html::beginTag('tr', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::endTag('td') ?>
                    <?= Html::beginTag('td', ['class' => 'container mailer-html-table-content-container1']) ?>
                        <?= Html::beginTag('div', ['class' => 'content mailer-html-div-content']) ?>
                            <?= Html::beginTag('table', ['class' => 'mailer-html-table1']) ?>
                                <?= Html::beginTag('tr', ['class' => 'mailer-html-table-content']) ?>
                                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                                        <?= Html::beginTag('td', ['class' => 'mailer-html-table-content-center']) ?>
                                            <?= Html::beginTag('p', ['class' => 'mailer-html-p-content']) ?>
                                                © <?= \Yii::$app->name ?> <?= date('Y') ?>.
                                            <?= Html::endTag('p') ?>
                                    <?= Html::endTag('td') ?>
                                <?= Html::endTag('tr') ?>
                            <?= Html::endTag('table') ?>
                        <?= Html::endTag('div') ?>
                    <?= Html::endTag('td') ?>
                    <?= Html::beginTag('td', ['class' => 'mailer-html-table-content']) ?>
                    <?= Html::endTag('td') ?>
                <?= Html::endTag('tr') ?>
            <?= Html::endTag('table') ?>
        <?= Html::endTag('body') ?>
    <?= Html::endTag('html') ?>
<?php $this->endPage();
