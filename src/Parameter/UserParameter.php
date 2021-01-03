<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Parameter;

final class UserParameter
{
    private array $assetClass;
    private bool $registerAsset;

    public function __construct(array $assetClass, bool $registerAsset)
    {
        $this->assetClass = $assetClass;
        $this->registerAsset = $registerAsset;
    }

    public function getAssetClass(): array
    {
        return $this->assetClass;
    }

    public function isRegisteredAsset(): bool
    {
        return $this->registerAsset;
    }
}
