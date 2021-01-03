<?php

declare(strict_types=1);

use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Recover your password.');

$assetManager->register(
    $userParameter->getAssetClass(),
);
?>

<h1 class="title text-center">
    <?= $translator->translate('Recover your password') ?>
</h1>

<div class="form-recovery-request">
    <?= Form::widget()
        ->action($urlGenerator->generate('request'))
        ->options(
            [
                'id' => 'form-recovery-request',
                'class' => 'forms-recovery-request',
                'csrf' => $csrf
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= Html::div(
            Html::submitButton(
                $translator->translate('Continue'),
                [
                    'class' => 'btn btn-primary btn-lg mt-3',
                    'name' => 'request-button',
                    'tabindex' => '2'
                ],
            ),
            ['class' => 'd-grid gap-2']
        ) ?>

        <hr class="mb-1"/>

        <div class="text-center">
            <?= Html::a(
                $translator->translate('Already registered - Sign in!'),
                $urlGenerator->generate('login'),
                ['tabindex' => '3']
            ) ?>
        </div>

    <?php Form::end() ?>
</div>
