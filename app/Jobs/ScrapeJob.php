<?php

namespace App\Jobs;

use App\DTOs\ScrapingDTO;
use App\Entities\Job;
use App\Managers\ScrapeJobManager;
use App\Services\WebScraperService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ScrapeJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param string $id
     * @param ScrapingDTO $DTO
     */
    public function __construct(private readonly string $id, private readonly ScrapingDTO $DTO)
    {
    }

    /**
     * @param WebScraperService $scraperService
     * @param ScrapeJobManager $jobManager
     * @return void
     */
    public function handle(WebScraperService $scraperService, ScrapeJobManager $jobManager): void
    {
        $status = Job::STATUS_COMPLETED;
        $scrapeResult = collect();
        try {
            $scrapeResult = $scraperService->getData($this->DTO);
        } catch (Exception $exception) {
            Log::error('Failed scraping the urls', [
                'error' => $exception->getMessage(),
                'data'  => $this->DTO,
                'id'    => $this->id,
            ]);
            $status = Job::STATUS_FAILED;
        }
        $jobManager->store(new Job([
            'id'     => $this->id,
            'status' => $status,
            'data'   => $scrapeResult,
        ]));
    }
}
