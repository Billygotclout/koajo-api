<?php

namespace App\Http\Requests\Ajo;

use Illuminate\Foundation\Http\FormRequest;

class JoinAjoRequest extends FormRequest
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
        return [
            'group_ajo_id' => ['required', 'numeric',],
            'order_no' => ['required', 'numeric', 'min:1', 'max:6']
        ];
    }
}
