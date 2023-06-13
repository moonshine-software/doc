<?php

namespace App\Support\PackageInfo\DTOs;

class PackageInfoDTO
{
    public function __construct(
        private readonly ?string $name,
        private readonly ?string $description,
        private readonly ?string $distUrl,
        private readonly ?string $repoUrl,
        private readonly ?string $package,
        private readonly ?string $readme
    )
    {
    }

    public static function fromArray(array $data): PackageInfoDTO
    {
        return new static(
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            distUrl: $data['distUrl'] ?? null,
            repoUrl: $data['repoUrl'] ?? null,
            package: $data['package'] ?? null,
            readme: $data['readme'] ?? null
        );
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDistUrl(): ?string
    {
        return $this->distUrl;
    }

    public function getRepoUrl(): ?string
    {
        return $this->repoUrl;
    }

    public function getPackage(): ?string
    {
        return $this->package;
    }

    public function getReadme(): ?string
    {
        return $this->readme;
    }
}
