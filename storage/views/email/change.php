<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

 /**
  * @var string|null $csrf
  * @var ModelInterface $data
  * @var Field $field
  * @var Translator $translator
  * @var UrlGeneratorInterface $urlGenerator
  * @var WebView $this
  */

$title = Html::encode($translator->translate('Change email address', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('email/change'))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-email-change')
            ->begin() ?>

            <?= $field->config($data, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <div class='d-grid gap-2'>
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Save', [], 'user-view'))
                    ->id('save-email-change')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>
</div>
