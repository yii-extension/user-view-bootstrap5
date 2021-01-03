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
?>

<h1 class="title text-center">
    <?= $translator->translate('Register') ?>
</h1>

<div class="form-registration-register">
    <?= Form::widget()
        ->action($urlGenerator->generate('register'))
        ->options(
            [
                'id' => 'form-registration-register',
                'class' => 'form-register',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= $field->config($data, 'username')->textInput(['tabindex' => '2']) ?>

        <?php if ($repositorySetting->isGeneratingPassword() === false) : ?>
            <?= $field->config($data, 'password')
                ->passwordInput(
                    [
                        'tabindex' => '3'
                    ]
                ) ?>
        <?php endif ?>

        <?= Html::div(
            Html::submitButton(
                $translator->translate('Register'),
                [
                    'class' => 'btn btn-primary btn-lg mt-3', 'id' => 'register-button', 'tabindex' => '4'
                ]
            ),
            ['class' => 'd-grid gap-2']
        ) ?>

        <hr class="mb-1"/>

    <?php Form::end() ?>

    <div class="text-center">
        <?= Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => '5']
        ) ?>
    </div>
</div>
