<?php

namespace App\Http\Requests\Ajo;

use App\Traits\EncryptionTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateAjoRequest extends FormRequest
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
      'title' => ['required',],
      'ajo_amount' => ['required',],
      'number_of_people' => ['required','numeric','min:3','max:6'], // max of 6
      'payment_schedule' => ['required', ], // weekly or monthly
      'type' => ['required',] ,//public or private
      'order_no' => ['required', 'numeric', 'min:1', 'max:6'],
    ];
  }
}
