<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\User\User;
use Yiisoft\Yii\View\ContentParametersInjectionInterface;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;

final class UserViewInjection implements ContentParametersInjectionInterface, LayoutParametersInjectionInterface
{
    private AssetManager $assetManager;
    private Field $field;
    private Locale $locale;
    private RepositorySetting $setting;
    private Translator $translator;
    private UrlGeneratorInterface $urlGenerator;
    private UrlMatcherInterface $urlMatcher;
    private User $user;

    public function __construct(
        AssetManager $assetManager,
        Field $field,
        Locale $locale,
        RepositorySetting $setting,
        Translator $translator,
        UrlGeneratorInterface $urlGenerator,
        UrlMatcherInterface $urlMatcher,
        User $user
    ) {
        $this->assetManager = $assetManager;
        $this->field = $field;
        $this->locale = $locale;
        $this->setting = $setting;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
        $this->urlMatcher = $urlMatcher;
        $this->user = $user;
    }

    public function getContentParameters(): array
    {
        return [
            'assetManager' => $this->assetManager,
            'field' => $this->field,
            'setting' => $this->setting,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
        ];
    }

    public function getLayoutParameters(): array
    {
        return [
            'assetManager' => $this->assetManager,
            'locale' => $this->locale,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
            'user' => $this->user,
        ];
    }
}
