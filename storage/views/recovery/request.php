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
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Recover your password.');

$tab = 0;

echo Html::tag('h1', $translator->translate('Login'), ['class' => 'text-center']);
?>

<div class="card bg-light mx-auto col-md-4">
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('request'))
            ->options(
                [
                    'id' => 'form-recovery-request',
                    'csrf' => $csrf,
                ]
            )
            ->begin() ?>

            <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Continue'),
                    [
                        'class' => 'btn btn-primary btn-lg mt-3',
                        'name' => 'request-button',
                        'tabindex' => ++$tab
                    ],
                ),
                ['class' => 'd-grid gap-2']
            ) ?>

        <?= Form::end() ?>

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
</div>
