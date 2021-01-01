<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Asset\Resend;
use App\Module\User\Form\FormResend;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Translator;
use Yiisoft\Router\UrlGeneratorInterface;

$this->setTitle('Resend confirmation message');

/**
 * @var string $action
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var Locale $locale
 * @var RepositorySetting $setting
 * @var UrlGeneratorInterface $urlGenerator
 * @var Translator $translator
 */

$assetManager->register([
    Resend::class
]);

?>

<h1 class="text-center">
    <?= $translator->translate('Resend confirmation message') ?>
</h1>

<div class = 'form-recovery-resend'>

    <?= Form::widget()
        ->action($urlGenerator->generate('resend'))
        ->options(
            [
                'id' => 'form-recovery-resend',
                'class' => 'form-resend',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= Html::div(
            Html::submitButton(
                $translator->translate('Continue'),
                [
                    'class' => 'btn btn-primary btn-lg mt-3', 'name' => 'resend-button', 'tabindex' => '2'
                ]
            ),
            ['class' => 'd-grid gap-2']
        ) ?>

    <?php Form::end(); ?>

    <hr class='mb-1'/>

    <?php if ($setting->isRegister()) : ?>
        <p class="text-center pt-3">
            <?= Html::a(
                $translator->translate("Don't have an account - Sign up!"),
                $urlGenerator->generate('register'),
                ['tabindex' => '3']
            ) ?>
        </p>
    <?php endif ?>

    <p class="text-center">
        <?= Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => '4']
        ) ?>
    </p>

</div>