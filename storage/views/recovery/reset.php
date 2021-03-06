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
 * @var string $code
 * @var Field $field
 * @var ModelInterface $model
 * @var string $id
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Reset your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-recovery-reset')
            ->begin() ?>

            <?= $field->config($model, 'password')->passwordInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <div class='d-grid gap-2'>
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Continue', [], 'user-view'))
                    ->id('reset-button')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>
</div>
