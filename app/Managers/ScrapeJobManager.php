<?php

namespace App\Managers;

use App\Contracts\JobStorageInterface;
use App\DTOs\ScrapingDTO;
use App\Entities\Job;
use App\Jobs\ScrapeJob;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ScrapeJobManager
{
    /**
     * @param JobStorageInterface $storage
     */
    public function __construct(
        private readonly JobStorageInterface $storage
    ) {
    }

    /**
     * @param ScrapingDTO $DTO
     * @return string
     */
    public function createJob(ScrapingDTO $DTO): string
    {
        $id = Str::uuid();
        $job = [
            'status' => Job::STATUS_WAITING,
            'data'   => null,
        ];
        $this->storage->store($id, $job);

        ScrapeJob::dispatch($id, $DTO);
        return $id;
    }

    /**
     * @param Job $job
     * @return Job
     */
    public function store(Job $job): Job
    {
        $this->storage->store($job['id'], Arr::except($job->jsonSerialize(), ['id']));
        return $job;
    }

    /**
     * @param string $id
     * @return Job|null
     */
    public function get(string $id): ?Job
    {
        $data = $this->storage->find($id);

        if (!$data) {
            return null;
        }
        return new Job($data + ['id' => $id]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->storage->delete($id);
    }
}
