<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckBookablePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

            case 'POST':
            case 'GET':
                return [
                    'from' => 'required|date_format:Y-m-d',
                    'to' => 'required|date_format:Y-m-d|after_or_equal:from'
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'from' => 'required|date_format:Y-m-d|after_or_equal:now,from,'.$this->id,
                    'to' => 'required|date_format:Y-m-d|after_or_equal:from,to,'.$this->id,
                ];

            case 'DELETE':
            default:
                return [];

        }
    }
}
