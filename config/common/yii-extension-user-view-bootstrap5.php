<?php

declare(strict_types=1);

use Yii\Extension\User\View\Parameter\UserParameter;

/** @var array $params */

return [
    UserParameter::class => [
        'class' => UserParameter::class,
        '__construct()' => [
            $params['yii-extension/user-view-bootstrap5']['assetClass'],
            $params['yii-extension/user-view-bootstrap5']['registerAsset'],
            $params['yii-extension/user-view-bootstrap5']['registerBootstrapAsset'],
            $params['yii-extension/user-view-bootstrap5']['registerBootstrapIconsAsset'],
        ],
    ],
];
