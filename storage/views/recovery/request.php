<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
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
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Request your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header fw-normal h3 text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('request'))
            ->attributes(['novalidate' => true])
            ->csrf($csrf)
            ->id('form-recovery-request')
            ->begin() ?>

            <?= $field->config($model, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <div class='d-grid gap-2'>
                <?= Button::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->class('btn btn-primary btn-lg mt-3')
                    ->content($translator->translate('Continue', [], 'user-view'))
                    ->id('request-button')
                    ->type('submit') ?>
            </div>
        <?= Form::end() ?>
    </div>

    <?php $items = Li::tag()
        ->class('list-group-item text-center')
        ->content(
            A::tag()
                ->attributes(['tabindex' => ++$tab])
                ->content($translator->translate('Already registered - Sign in!', [], 'user-view'))
                ->url($urlGenerator->generate('login'))
                ->render()
        )
        ->encode(false)
    ?>

    <?= Ul::tag()->class('card-footer list-group list-group-flush mb-2 ')->items($items) ?>
</div>
