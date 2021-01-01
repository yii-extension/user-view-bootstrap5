<?php

declare(strict_types=1);

use Yii\Extension\User\settings\RepositorySetting;
use Yii\Extension\User\View\Asset\Login;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Translator;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\View\WebView;

/**
 * @var Aliases $aliases
 * @var string $action
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var bool $isPasswordRecovery
 * @var string $linkResend
 * @var Locale $locale
 * @var RepositorySetting $setting
 * @var WebView $this
 * @var MessageSource $translator
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 */

$this->setTitle('Login');

$assetManager->register([
    Login::class,
]);
?>

<h1 class="text-center">
    <?= $translator->translate('Login') ?>
</h1>

<div class = 'form-auth-login'>

    <?= Form::widget()
        ->action($urlGenerator->generate('login'))
        ->options(
            [
                'id' => 'form-auth-login',
                'class' => 'form-auth-login',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= $field->config($data, 'password')->passwordInput(['tabindex' => '2']) ?>

        <?= Html::div(
            Html::submitButton(
                $translator->translate('Login') .
                html::tag('i', '', ['class' => 'bi bi-box-arrow-in-right ms-2', 'aria-hidden' => 'true']),
                [
                    'class' => 'btn btn-primary btn-lg mt-3',
                    'id' => 'login-button',
                    'tabindex' => '3',
                ]
            ),
            ['class' => 'd-grid gap-2']
        ) ?>

    <?= Form::end() ?>

    <hr class='mb-1'/>

    <?php if ($setting->isPasswordRecovery()) : ?>
        <p class="text-center">
            <?= Html::a(
                $translator->translate('Forgot password'),
                $urlGenerator->generate('request'),
                ['tabindex' => '4'],
            ) ?>
        </p>
    <?php endif ?>

    <p class="text-center">
        <?= Html::a(
            $translator->translate('Don\'t have an account - Sign up!'),
            $urlGenerator->generate('register'),
            ['tabindex' => '5'],
        ) ?>
    </p>

    <?php if ($setting->isConfirmation() === true) : ?>
        <p class="text-center">
            <?= Html::a(
                $translator->translate("Didn't receive confirmation message"),
                $urlGenerator->generate('resend'),
                ['tabindex' => '6'],
            ) ?>
        </p>
    <?php endif ?>

</div>
