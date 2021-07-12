<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Li;
use Yiisoft\Html\Tag\Ul;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var ModuleSettings $moduleSettings
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Log in', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body mt-2">
        <?= Form::widget()
            ->action($urlGenerator->generate('login'))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-auth-login')
            ->begin() ?>

            <?= $field->config($model, 'login')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= $field->config($model, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

            <div class="d-grid gap-2">
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Log in', [], 'user-view'))
                    ->id('login-button')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>

    <?php if ($moduleSettings->isPasswordRecovery()) : ?>
        <?php $items[] = Li::tag()
            ->class('border-0 list-group-item text-center')
            ->content(
                A::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->content($translator->translate('Forgot password', [], 'user-view'))
                    ->url($urlGenerator->generate('request'))
                    ->render()
            )
            ->encode(false)
        ?>
    <?php endif ?>

    <?php if ($moduleSettings->isRegister()) : ?>
        <?php $items[] = Li::tag()
            ->class('border-0 list-group-item text-center')
            ->content(
                A::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->content($translator->translate('Don\'t have an account - Sign up!', [], 'user-view'))
                    ->url($urlGenerator->generate('register'))
                    ->render()
            )
            ->encode(false)
        ?>
    <?php endif ?>

    <?php if ($moduleSettings->isConfirmation() === true) : ?>
        <?php $items[] = Li::tag()
            ->class('border-0 list-group-item text-center')
            ->content(
                A::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->content($translator->translate('Didn\'t receive confirmation message', [], 'user-view'))
                    ->url($urlGenerator->generate('resend'))
                    ->render()
            )
            ->encode(false)
        ?>
    <?php endif ?>

    <?= Ul::tag()->class('card-footer list-group list-group-flush mb-2')->items(...$items) ?>
</div>
