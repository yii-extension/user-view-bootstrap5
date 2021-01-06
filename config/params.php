<?php

declare(strict_types=1);

use Yii\Extension\User\View\UserViewInjection;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-view-css' =>  dirname(__DIR__) . '/storage/asset/css',
            '@user-view-language' => dirname(__DIR__) . '/storage/language',
            '@user-view-mail' =>  dirname(__DIR__) . '/storage/mail',
            '@user-view-views' => dirname(__DIR__) . '/storage/views',
        ]
    ],

    'yiisoft/mailer' => [
        'composer' => [
            'composerView' => '@user-view-mail',
        ],
    ],

    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(CsrfViewInjection::class),
            Reference::to(UserViewInjection::class),
        ],
    ],
];
