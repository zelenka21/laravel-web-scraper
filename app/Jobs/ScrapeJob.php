<?php

namespace App\Jobs;

use App\DTOs\ScrapingDTO;
use App\Entities\Job;
use App\Services\WebScraperService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Redis;

class ScrapeJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;

    /**
     * @param string $id
     * @param ScrapingDTO $DTO
     */
    public function __construct(private readonly string $id, private readonly ScrapingDTO $DTO)
    {
    }

    /**
     * @param WebScraperService $scraperService
     * @return void
     */
    public function handle(WebScraperService $scraperService): void
    {
        $status = Job::STATUS_COMPLETED;
        try {
            $scrapeResult = $scraperService->getData($this->DTO);
        } catch (Exception $exception) {
            $status = "failed";
        }
        Redis::set($this->id, json_encode([
            'status' => $status,
            'data'   => $scrapeResult
        ]));
    }
}
