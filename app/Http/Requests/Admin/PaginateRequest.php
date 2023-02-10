<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'page'     => 'integer|min:1',
            'per_page' => 'integer|min:1',
        ];
    }
}
