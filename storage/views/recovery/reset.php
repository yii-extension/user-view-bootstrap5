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
 * @var string $code
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var string $id
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Reset your password.');

$assetManager->register(
    $userParameter->getAssetClass(),
);

$tab = 0;
?>

<h1 class="text-center">
    <?= $translator->translate('Reset your password') ?>
</h1>

<div class="card bg-light mx-auto col-md-5">
    <div class="card-body">
        <p class="card-text">
            <?= Form::widget()
                ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
                ->options(
                    [
                        'id' => 'form-recovery-reset',
                        'csrf' => $csrf,
                    ]
                )
                ->begin() ?>

                <?= $field->config($data, 'password')->passwordInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                <?= Html::submitButton(
                    $translator->translate('Continue'),
                    [
                        'class' => 'btn btn-primary btn-lg mt-3',
                        'name' => 'reset-button',
                        'tabindex' => '2'
                    ]
                ) ?>

            <?= Form::end() ?>
        </p>
</div>
