<?php

namespace App\Modules\Core\Presentation;

use Illuminate\Foundation\Http\FormRequest;

class AbstractFormRequest extends FormRequest
{
    public ?string $filterName;

    public ?int $pageSize;
    public ?int $pageNumber;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->pageSize = (int) $this->input('page.size') ? $this->input('page.size') : env('DEFAULT_PAGE_SIZE');
        $this->pageNumber = (int) $this->input('page.number') ? $this->input('page.number') : env('DEFAULT_PAGE_NUMBER');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
