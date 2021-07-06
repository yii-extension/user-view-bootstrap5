<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\User\Helper\TimeZone;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Profile', [], 'user-view'));

$this->setTitle($title);

$timezone = new TimeZone();

$csrf = $csrf ?? '';
$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('profile'))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-profile-profile')
            ->begin() ?>

            <?= $field->config($data, 'name')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'publicEmail')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'website')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'location')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'timezone')
                ->dropDownList(
                    ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
                    ['class' => 'form-select', 'tabindex' => ++$tab]
                ) ?>

            <?= $field
                ->config($data, 'bio')
                ->textArea(['class' => 'form-control textarea', 'rows' => 2, 'tabindex' => ++$tab]) ?>

            <div class='d-grid gap-2'>
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Save', [], 'user-view'))
                    ->id('save-profile')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>
</div>
