<?php

declare(strict_types=1);

use Yii\Extension\User\RepositorySettings;
use Yii\Extension\User\Form\RegisterForm;
use Yii\Extension\User\View\Asset\Register;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Message\Php\MessageSource;

$this->setTitle('Register');

 /**
  * @var string $action
  * @var AssetManager $assetManager
  * @var string|null $csrf
  * @var RegisterForm $data
  * @var Field $field
  * @var Locale $locale
  * @var RepositorySettings $settings
  * @var UrlGeneratorInterface $url
  * @var MessageSource $translator
  */

$assetManager->register([
    Register::class
]);

?>

<p class="title form-registration-register-title">
    <?= $translator->translate('Register') . '.' ?>
</p>

<p class="subtitle form-registration-register-subtitle">
    <?= $translator->translate('Please fill out the following') ?>
</p>

<hr class='mb-2'/>

<div class = 'form-registration-register'>

    <?= Form::widget()
        ->action($urlGenerator->generate('register'))
        ->options(
            [
                'id' => 'form-registration-register',
                'class' => 'form-register',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')
            ->textInput(
                [
                    'placeholder' => $translator->translate('Email'),
                    'tabindex' => '1'
                ]
            ) ?>

        <?= $field->config($data, 'username')
            ->textInput(
                [
                    'placeholder' => $translator->translate('Username'),
                    'tabindex' => '2'
                ]
            ) ?>

        <?php if ($setting->isGeneratingPassword() === false) : ?>
            <?= $field->config($data, 'password')
                ->passwordInput(
                    [
                        'placeholder' => $translator->translate('Password'),
                        'tabindex' => '3'
                    ]
                ) ?>
        <?php endif ?>

        <?= Html::div(
            Html::submitButton(
                $translator->translate('Register'),
                [
                    'class' => 'btn btn-primary btn-lg mt-3', 'id' => 'register-button', 'tabindex' => '4'
                ]
            ),
            ['class' => 'd-grid gap-2']
        ) ?>


        <hr class='mb-2'/>

        <div class = 'text-center pt-3'>
            <?= Html::a(
                $translator->translate('Already registered - Sign in!'),
                $urlGenerator->generate('login'),
                ['tabindex' => '5']
            ) ?>
        </div>

    <?php Form::end() ?>

</div>
