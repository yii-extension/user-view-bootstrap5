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
 * @var ModelInterface $data
 * @var ModuleSettings $moduleSettings
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Resend confirmation message', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('resend'))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-recovery-resend')
            ->begin() ?>

            <?= $field->config($data, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <div class='d-grid gap-2'>
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Continue', [], 'user-view'))
                    ->id('resend-button')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>

    <?php if ($moduleSettings->isRegister()) : ?>
        <?php $items[] = Li::tag()
            ->class('border-0 list-group-item text-center')
            ->content(
                A::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->content($translator->translate('Don\'t have an account - Sign up!', [], 'user-view'))
                ->url($urlGenerator->generate('register'))
            )
        ?>
    <?php endif ?>

    <?php $items[] = Li::tag()
        ->class('list-group-item text-center')
        ->content(
            A::tag()
                ->attributes(['tabindex' => ++$tab])
                ->content($translator->translate('Already registered - Sign in!', [], 'user-view'))
                ->url($urlGenerator->generate('login'))
        )
    ?>

    <?= Ul::tag()->class('card-footer list-group list-group-flush mb-2')->items(...$items) ?>
</div>
