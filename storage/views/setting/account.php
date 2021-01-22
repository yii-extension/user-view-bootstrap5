<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

 /**
  * @var string|null $csrf
  * @var FormModelInterface $data
  * @var Field $field
  * @var RepositorySetting $repositorySetting
  * @var Translator $translator
  * @var UrlGeneratorInterface $urlGenerator
  * @var WebView $this
  */

$title = Html::encode($translator->translate('Change email address', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$tab = 0;
?>

<div class="card shadow mx-auto col-md-4">
    <h1 class="card-header text-center"><?= $title ?></h1>
        <div class="card-body">
            <?= Form::widget()
                ->action($urlGenerator->generate('account'))
                ->options(['csrf' => $csrf, 'id' => 'form-setting-account'])
                ->begin() ?>

                <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                <?= Html::div(
                    Html::submitButton(
                        $translator->translate('Save', [], 'user-view'),
                        [
                            'class' => 'btn btn-primary btn-lg my-3',
                            'id' => 'save-account',
                            'tabindex' => ++$tab,
                        ]
                    ),
                    ['class' => 'd-grid gap-2']
                ) ?>

            <?= Form::end() ?>
        </div>
    </h1>
</div>
