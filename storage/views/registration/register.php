<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

 /**
  * @var AssetManager $assetManager
  * @var string|null $csrf
  * @var FormModelInterface $data
  * @var Field $field
  * @var Locale $locale
  * @var RepositorySetting $repositorySetting
  * @var Translator $translator
  * @var UrlGeneratorInterface $urlGenerator
  * @var UserParameter $userParameter
  * @var WebView $this
  *
  * @psalm-suppress InvalidScope
  */

$this->setTitle('Register');

$assetManager->register(
    $userParameter->getAssetClass(),
);

$tab = 0;
?>

<h1 class="text-center">
    <?= $translator->translate('Register') ?>
</h1>

<div class="card bg-light mx-auto col-md-5">
    <div class="card-body">
        <p class="card-text">
            <?= Form::widget()
                ->action($urlGenerator->generate('register'))
                ->options(
                    [
                        'id' => 'form-registration-register',
                        'csrf' => $csrf,
                    ]
                )
                ->begin() ?>

                <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                <?= $field->config($data, 'username')->textInput(['tabindex' => ++$tab]) ?>

                <?php if ($repositorySetting->isGeneratingPassword() === false) : ?>
                    <?= $field->config($data, 'password')
                        ->passwordInput(
                            [
                                'tabindex' => ++$tab
                            ]
                        ) ?>
                <?php endif ?>

                <?= Html::div(
                    Html::submitButton(
                        $translator->translate('Register'),
                        [
                            'class' => 'btn btn-primary btn-lg mt-3', 'id' => 'register-button', 'tabindex' => ++$tab
                        ]
                    ),
                    ['class' => 'd-grid gap-2']
                ) ?>

            <?= Form::end() ?>
        </p>

    <?php
    $items = [];

    $items[] = Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => ++$tab],
        );

    echo Html::ul(
        $items,
        [
            'class' => 'list-group list-group-flush pt-3',
            'encode' => false,
            'itemOptions' => ['class' => 'list-group-item text-center bg-light']
        ]
    );
    ?>
</div>
