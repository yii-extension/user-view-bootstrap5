<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

 /**
  * @var string|null $csrf
  * @var FormModelInterface $data
  * @var Field $field
  * @var Locale $locale
  * @var RepositorySetting $repositorySetting
  * @var Translator $translator
  * @var UrlGeneratorInterface $urlGenerator
  * @var WebView $this
  */

$title = Html::encode($translator->translate('Register'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('register'))
            ->options(['csrf' => $csrf, 'id' => 'form-registration-register'])
            ->begin() ?>

            <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'username')->textInput(['tabindex' => ++$tab]) ?>

            <?php if ($repositorySetting->isGeneratingPassword() === false) : ?>
                <?= $field->config($data, 'password')->passwordInput(['tabindex' => ++$tab]) ?>
            <?php endif ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Register'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3', 'id' => 'register-button', 'tabindex' => ++$tab
                    ]
                ),
                ['class' => 'd-grid gap-2']
            ) ?>

        <?= Form::end() ?>
    </div>

    <?php
    $items[] = Html::a(
        $translator->translate('Already registered - Sign in!'),
        $urlGenerator->generate('login'),
        ['tabindex' => ++$tab],
    );

    echo Html::ul(
        $items,
        [
            'class' => 'list-group list-group-flush',
            'encode' => false,
            'itemOptions' => ['class' => 'list-group-item text-center']
        ]
    );
    ?>
</div>
