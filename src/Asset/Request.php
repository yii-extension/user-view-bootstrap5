<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Yii\Bootstrap5\Assets\BootstrapAsset;

final class Request extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@user-view-css';

    public array $css = [
        'request.css',
    ];

    public array $depends = [
        BootstrapAsset::class
    ];
}
