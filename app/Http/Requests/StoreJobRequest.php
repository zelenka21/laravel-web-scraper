<?php

namespace App\Http\Requests;

use App\DTOs\ScrapingDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'urls'        => ['required', 'array', 'min:1'],
            'urls.*'      => ['url'],
            'selectors'   => ['required', 'array', 'min:1'],
            'selectors.*' => ['string']
        ];
    }

    public function toDTO(): ScrapingDTO
    {
        return new ScrapingDTO(
            $this->validated()['urls'],
            $this->validated()['selectors'],
        );
    }
}
