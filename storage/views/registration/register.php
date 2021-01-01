<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Asset\Register;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;

$this->setTitle('Register');

 /**
  * @var string $action
  * @var AssetManager $assetManager
  * @var string|null $csrf
  * @var FormModelInterface $data
  * @var Field $field
  * @var Locale $locale
  * @var RepositorySetting $setting
  * @var Translator $translator
  * @var UrlGeneratorInterface $urlGenerator
  */

$assetManager->register([
    Register::class
]);

?>

<h1 class="title form-registration-register-title">
    <?= $translator->translate('Register') ?>
</h1>

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

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= $field->config($data, 'username')->textInput(['tabindex' => '2']) ?>

        <?php if ($setting->isGeneratingPassword() === false) : ?>
            <?= $field->config($data, 'password')
                ->passwordInput(
                    [
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

        <hr class='mb-1'/>

    <?php Form::end() ?>

    <div class="text-center">
        <?= Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => '5']
        ) ?>
    </div>

</div>
