<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Asset;

use Yiisoft\Assets\AssetBundle;

final class UserAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@user-view-css';

    public array $css = [
        'user-view-bootstrap5.css',
    ];
}
