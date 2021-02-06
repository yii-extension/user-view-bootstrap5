<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\Widget\AlertMessage;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Translator\Translator;
use Yiisoft\Router\UrlGeneratorInterface;
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

$title = Html::encode($translator->translate('Log in', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$tab = 0;
$items = [];
?>

<?= AlertMessage::widget() ?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('login'))
            ->options(['csrf' => $csrf, 'id' => 'form-auth-login'])
            ->begin() ?>

            <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

            <?= $field->config($data, 'remember')
                ->checkbox(
                    [
                        'class' => 'form-check-input',
                        'labelOptions' => ['class' => 'form-check-label'],
                        'tabindex' => ++$tab,
                    ]
                )
                ->enclosedByContainer(true, ['class' => 'form-switch']) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Log in', [], 'user-view'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3',
                        'id' => 'login-button',
                        'tabindex' => ++$tab,
                    ]
                ),
                ['class' => 'd-grid gap-2', 'encode' => false],
            ) ?>

        <?= Form::end() ?>
    </div>

    <?php
    if ($repositorySetting->isPasswordRecovery()) {
        $items[] = Html::a(
            $translator->translate('Forgot password', [], 'user-view'),
            $urlGenerator->generate('request'),
            ['tabindex' => ++$tab],
        );
    }

    if ($repositorySetting->isRegister()) {
        $items[] = Html::a(
            $translator->translate('Don\'t have an account - Sign up!', [], 'user-view'),
            $urlGenerator->generate('register'),
            ['tabindex' => ++$tab],
        );
    }

    if ($repositorySetting->isConfirmation() === true) {
        $items[] =  Html::a(
            $translator->translate('Didn\'t receive confirmation message', [], 'user-view'),
            $urlGenerator->generate('resend'),
            ['tabindex' => ++$tab],
        );
    }

    echo Html::ul(
        $items,
        [
            'class' => 'list-group list-group-flush',
            'itemOptions' => ['class' => 'list-group-item text-center', 'encode' => false],
        ]
    );
    ?>
</div>
