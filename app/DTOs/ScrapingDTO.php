<?php

namespace App\DTOs;

class ScrapingDTO
{
    /**
     * @param UrlDetailsDTO[] $urls
     */
    public function __construct(
        private readonly array $urls,
    ) {
    }

    /**
     * @return UrlDetailsDTO[]
     */
    public function getUrls(): array
    {
        return $this->urls;
    }
}
