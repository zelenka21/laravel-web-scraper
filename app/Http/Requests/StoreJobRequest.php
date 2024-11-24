<?php

namespace App\Http\Requests;

use App\DTOs\ScrapingDTO;
use App\DTOs\UrlDetailsDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'data'               => ['required', 'array', 'min:1'],
            'data.*.url'         => ['required', 'url'],
            'data.*.selectors'   => ['required', 'array', 'min:1'],
            'data.*.selectors.*' => ['required', 'string']
        ];
    }

    /**
     * @return ScrapingDTO
     */
    public function toDTO(): ScrapingDTO
    {
        $urlDetails = collect($this->validated()['jobs'])->map(function ($job) {
            return new UrlDetailsDTO(
                $job['url'],
                $job['selectors']
            );
        })->toArray();

        return new ScrapingDTO($urlDetails);
    }
}
