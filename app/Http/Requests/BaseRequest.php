<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class BaseRequest extends FormRequest
{
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $dataResponse = [
            'now' => Carbon::now()->toDateTimeString(),
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'data' => [],
            'message' => $validator->errors()->toArray(),
        ];

        throw new HttpResponseException(response()->json($dataResponse, Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * @return array
     */
    public function dataValidated(): array
    {
        $typesVariable = ['integer', 'string', 'array'];
        $params = $this->validated();
        foreach($this->rules() as $field => $rules) {
            if (!$field || !$rules) {
                continue;
            }
            if (is_string($rules)) {
                $rules = explode('|', $rules);
            }
            $typeOfRule = $rules[0] ?? '';
            if (!in_array($typeOfRule, $typesVariable)) {
                continue;
            }
            if(isset($params[$field])) {
                settype($params[$field], $typeOfRule);
            }
        }
        return $params;
    }

}
