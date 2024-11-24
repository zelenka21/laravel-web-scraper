<?php

namespace App\DTOs;

class ScrapingDTO
{
    /**
     * @param array $urls
     * @param array $selectors
     */
    public function __construct(
        private readonly array $urls,
        private readonly array $selectors,
    ) {
    }

    /**
     * @return array
     */
    public function getUrls(): array
    {
        return $this->urls;
    }

    /**
     * @return array
     */
    public function getSelectors(): array
    {
        return $this->selectors;
    }
}
