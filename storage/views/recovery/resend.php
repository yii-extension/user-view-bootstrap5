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
 * @var UrlGeneratorInterface $urlGenerator
 * @var Translator $translator
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Resend confirmation message');

$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $translator->translate('Resend confirmation message') ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('resend'))
            ->options(
                [
                    'id' => 'form-recovery-resend',
                    'csrf' => $csrf,
                ]
            )
            ->begin() ?>

            <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Continue'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3', 'name' => 'resend-button', 'tabindex' => ++$tab
                    ]
                ),
                ['class' => 'd-grid gap-2']
            ) ?>

        <?= Form::end() ?>
    </div>

    <?php
    if ($repositorySetting->isRegister()) {
        $items[] = Html::a(
            $translator->translate('Don\'t have an account - Sign up!'),
            $urlGenerator->generate('register'),
            ['tabindex' => ++$tab],
        );
    }

    $items[] =  Html::a(
        $translator->translate('Already registered - Sign in!'),
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
