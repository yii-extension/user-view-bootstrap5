<?php

declare(strict_types=1);

use Yii\Extension\User\Helper\TimeZone;
use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Profile'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$timezone = new TimeZone();

$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('profile'))
            ->options(['csrf' => $csrf, 'id' => 'form-profile-profile'])
            ->begin() ?>

            <?= $field->config($data, 'name')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'publicEmail')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'website')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'location')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'timezone')
                ->dropDownList(
                    ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
                    ['tabindex' => ++$tab]
                ) ?>

            <?= $field->config($data, 'bio')
                ->textarea(['class' => 'form-control textarea', 'rows' => 2,'tabindex' => ++$tab]) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Save'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3',
                        'id' => 'save-profile',
                        'tabindex' => ++$tab,
                    ]
                ),
                ['class' => 'd-grid gap-2']
            ) ?>

        <?= Form::end() ?>
    </div>
</div>
