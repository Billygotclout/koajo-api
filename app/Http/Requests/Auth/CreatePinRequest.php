<?php

namespace App\Http\Requests\Auth;

use App\Traits\EncryptionTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreatePinRequest extends FormRequest
{

    use EncryptionTrait;
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
            'user_id' => ['required'],
            'pin' => ['required','integer','confirmed']
        ];
    }

    protected function prepareForValidation()
    {
        
        if($this->request->has('user_id')){
            $this->merge([
                'user_id' => $this->decrypt($this->user_id)
            ]);
        }
        
    }
}
