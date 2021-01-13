<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Request your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('request'))
            ->options(['csrf' => $csrf, 'id' => 'form-recovery-request'])
            ->begin() ?>

            <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Continue', [], 'user-view'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3',
                        'name' => 'request-button',
                        'tabindex' => ++$tab
                    ],
                ),
                ['class' => 'd-grid gap-2']
            ) ?>

        <?= Form::end() ?>
    </div>

    <?php
    $items[] = Html::a(
        $translator->translate('Already registered - Sign in!', [], 'user-view'),
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
