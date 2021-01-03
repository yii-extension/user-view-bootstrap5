<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Translator;
use Yiisoft\Router\UrlGeneratorInterface;
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
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Login');

$tab = 0;
?>

<h1 class="text-center">
    <?= $translator->translate('Login') ?>
</h1>

<div class="card bg-light mx-auto col-md-5">
    <div class="card-body">
        <p class="card-text">
            <?= Form::widget()
                ->action($urlGenerator->generate('login'))
                ->options(
                    [
                        'id' => 'form-auth-login',
                        'csrf' => $csrf,
                    ]
                )
                ->begin() ?>

                <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                <?= $field->config($data, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

                <?= Html::div(
                    Html::submitButton(
                        $translator->translate('Login') .
                        html::tag('i', '', ['class' => 'bi bi-box-arrow-in-right ms-2', 'aria-hidden' => 'true']),
                        [
                            'class' => 'btn btn-primary btn-lg mt-3',
                            'id' => 'login-button',
                            'tabindex' => ++$tab,
                        ]
                    ),
                    ['class' => 'd-grid gap-2']
                ) ?>

            <?= Form::end() ?>
        </p>

    <?php
    $items = [];

    if ($repositorySetting->isPasswordRecovery()) {
        $items[] = Html::a(
                $translator->translate('Forgot password'),
                $urlGenerator->generate('request'),
                ['tabindex' => ++$tab],
            );
    }

    if ($repositorySetting->isRegister()) {
        $items[] = Html::a(
            $translator->translate('Don\'t have an account - Sign up!'),
            $urlGenerator->generate('register'),
            ['tabindex' => ++$tab],
        );
    }

    if ($repositorySetting->isConfirmation() === true) {
        $items[] =  Html::a(
            $translator->translate("Didn't receive confirmation message"),
            $urlGenerator->generate('resend'),
            ['tabindex' => ++$tab],
        );
    }

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
