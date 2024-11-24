<?php

namespace App\Services;

use App\DTOs\ScrapingDTO;
use App\DTOs\UrlDetailsDTO;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Collection;

class WebScraperService
{
    /**
     * @param Client $client
     */
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * @param ScrapingDTO $DTO
     * @return Collection
     */
    public function getData(ScrapingDTO $DTO): Collection
    {
        return collect($DTO->getUrls())->map(function (UrlDetailsDTO $urlDetails) {
            $url = $urlDetails->getUrl();
            $selectors = $urlDetails->getSelectors();

            $response = $this->client->get($url);
            $crawler = new Crawler($response->getBody()->getContents());

            $data = collect($selectors)->mapWithKeys(function ($selector) use ($crawler) {
                return [
                    $selector => $crawler->filter($selector)
                        ->each(fn (Crawler $node) => trim($node->text())),
                ];
            });

            return [
                'url' => $url,
                'data' => $data,
            ];
        });
    }
}
