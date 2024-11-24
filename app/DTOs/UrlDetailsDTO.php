<?php

namespace App\DTOs;

class UrlDetailsDTO
{
    /**
     * @param string $url
     * @param array $selectors
     */
    public function __construct(
        private readonly string $url,
        private readonly array $selectors,
    ) {
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getSelectors(): array
    {
        return $this->selectors;
    }
}
