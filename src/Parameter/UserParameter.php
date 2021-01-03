<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Parameter;

use Yii\Extension\User\View\Asset\BootstrapIconsAsset;
use Yiisoft\Yii\Bootstrap5\Assets\BootstrapAsset;

final class UserParameter
{
    private array $assets = [];
    private bool $registerAsset;
    private bool $registerBootstrapAsset;
    private bool $registerBootstrapIconsAsset;

    public function __construct(
        bool $registerAsset,
        bool $registerBootstrapAsset,
        bool $registerBootstrapIconsAsset
    ) {
        $this->registerAsset = $registerAsset;
        $this->registerBootstrapAsset = $registerBootstrapAsset;
        $this->registerBootstrapIconsAsset = $registerBootstrapIconsAsset;
    }

    public function getAssetClass(): array
    {
        if ($this->registerBootstrapAsset) {
            $this->assets[] = BootstrapAsset::class;
        }

        if ($this->registerBootstrapIconsAsset) {
            $this->assets[] = BootstrapIconsAsset::class;
        }

        return $this->assets;
    }
}
