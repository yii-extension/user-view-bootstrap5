<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
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
 * @var UrlGeneratorInterface $urlGenerator
 * @var Translator $translator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Resend confirmation message', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$tab = 0;
$items = [];
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
    <div class="card-body">
        <?= Form::widget()
            ->action($urlGenerator->generate('resend'))
            ->options(['csrf' => $csrf, 'id' => 'form-recovery-resend'])
            ->begin() ?>

            <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

            <?= Html::div(
                Html::submitButton(
                    $translator->translate('Continue', [], 'user-view'),
                    [
                        'class' => 'btn btn-primary btn-lg my-3', 'name' => 'resend-button', 'tabindex' => ++$tab
                    ]
                ),
                ['class' => 'd-grid gap-2', 'encode' => false]
            ) ?>

        <?= Form::end() ?>
    </div>

    <?php
    if ($repositorySetting->isRegister()) {
        $items[] = Html::a(
            $translator->translate('Don\'t have an account - Sign up!', [], 'user-view'),
            $urlGenerator->generate('register'),
            ['tabindex' => ++$tab],
        );
    }

    $items[] =  Html::a(
        $translator->translate('Already registered - Sign in!', [], 'user-view'),
        $urlGenerator->generate('login'),
        ['tabindex' => ++$tab],
    );

    echo Html::ul(
        $items,
        [
            'class' => 'list-group list-group-flush',
            'itemOptions' => ['class' => 'list-group-item text-center', 'encode' => false]
        ]
    );
    ?>
</div>
