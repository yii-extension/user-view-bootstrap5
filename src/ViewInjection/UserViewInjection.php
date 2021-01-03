<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\User\User;
use Yiisoft\Yii\View\ContentParametersInjectionInterface;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;

final class UserViewInjection implements ContentParametersInjectionInterface, LayoutParametersInjectionInterface
{
    private Field $field;
    private RepositorySetting $repositorySetting;
    private Translator $translator;
    private UrlGeneratorInterface $urlGenerator;
    private UrlMatcherInterface $urlMatcher;
    private User $user;

    public function __construct(
        Field $field,
        RepositorySetting $repositorySetting,
        Translator $translator,
        UrlGeneratorInterface $urlGenerator,
        UrlMatcherInterface $urlMatcher,
        User $user
    ) {
        $this->field = $field;
        $this->repositorySetting = $repositorySetting;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
        $this->urlMatcher = $urlMatcher;
        $this->user = $user;
    }

    public function getContentParameters(): array
    {
        return [
            'field' => $this->field,
            'repositorySetting' => $this->repositorySetting,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
        ];
    }

    public function getLayoutParameters(): array
    {
        return [
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
            'user' => $this->user,
        ];
    }
}
