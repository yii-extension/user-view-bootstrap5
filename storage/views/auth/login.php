<?php

declare(strict_types=1);

use Yii\Extension\User\View\Asset\Login;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\View\WebView;

/**
 * @var Aliases Aliases
 * @var string $action
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var bool $isPasswordRecovery
 * @var string $linkResend
 * @var Locale $locale
 * @var WebView $this
 */

$this->setTitle('Login');

$assetManager->register([
    Login::class,
]);

?>

<h1 class="title form-security-login-title">
    <?= $translator->translate('Sign in') ?>
</h1>

<p class="subtitle form-security-login-subtitle ">
    <?= $translator->translate('Please fill out the following') ?>
</p>

<hr class='mb-2'/>

<div class = 'form-security-login'>

    <?= Form::widget()
        ->action($urlGenerator->generate('login'))
        ->options(
            [
                'id' => 'form-security-login',
                'class' => 'form-login',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'login')
            ->textInput(
                [
                    'autofocus' => true,
                    'tabindex' => '1'
                    ]
            ) ?>

        <?= $field->config($data, 'password')
            ->passwordInput(
                [
                    'tabindex' => '2'
                ]
            ) ?>

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

    <?php if ($setting->isPasswordRecovery() === true) : ?>
        <p class = 'has-text-grey has-margin-top-10'>
            <?= Html::a(
                $translator->translate('Forgot Password'),
                '#', /*$url->generate('recovery/request'), */
                ['tabindex' => '4'],
            ) ?>
        </p>
    <?php endif ?>

    <?php if ($setting->isConfirmation() === true) : ?>
        <p class = 'has-text-grey'>
            <?= Html::a(
                $translator->translate("Didn't receive confirmation message"),
                $urlGenerator->generate('resend'),
                ['tabindex' => '5'],
            ) ?>
        </p>
    <?php endif ?>

</div>
