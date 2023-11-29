<?php

namespace App\Actions\AjoSystem;

use App\Models\Ajo;
use App\Models\AjoUser;
use App\Models\AjoGroups;
use App\Models\User;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use Illuminate\Support\Arr;

class CreateAjoAction
{

  use ApiResponse;
  use EncryptionTrait;
  use ActivityLogTrait;

  protected $code;


  protected $data;

  public function execute(array $data)
  {
    $this->data = $data;




      $this->code = $this->generateRandomAlphaNumeric();
   

    $userId = auth()->user()->id;

    $this->user = User::where('id', $userId)->first();


    $ajo = [
      'user_id' => auth()->user()->id,
      'title' => $data['title'],
      'ajo_amount' => $data['ajo_amount'],
      'number_of_people' => $data['number_of_people'],
      'payment_schedule' => $data['payment_schedule'],
      'type' => $data['type'],
      'code' => $this->code
    ];

    // check if payout order number higher than the ajo number
    if ($data['order_no'] > $data['number_of_people']) {
      return $this->error(
        'Cannot choose a number higher than the number of members inputted!',
        401
      );
    }

    $newAjo = Ajo::create($ajo);

 AjoUser::create([
      'user_id' => auth()->user()->id,
      'first_name' => $this->user->first_name,
      'group_id' => $newAjo->id,
      'order_no' => $data['order_no'],
      'payment_status' => array()
    ]);

    if (!$newAjo) {
      return $this->error("Error creating Ajo", 400);
    }

    $group = Ajo::findOrFail($newAjo->id);



    // give the person the order number
    $number = $data['order_no'];

    $members = AjoGroups::all('members_id')->toArray();

    array_push($members, $userId);

    $order_numbers = AjoGroups::all('members_order_no')->toArray();
    array_push($order_numbers, $number);
    // store in Ajo Groups
    $ajoGroup = [
      'group_id' => $newAjo->id,
      'creator_user_id' => $userId, //gotten from Ajo table
      'creator_firstname' => $this->user->first_name,
      'members_id' => $members,
      'members_order_no' => $order_numbers,
      'amount' => $newAjo->ajo_amount // gotten from Ajo table
    ];

    AjoGroups::create($ajoGroup);

    $title = "Ajo creation";

    $userActivity = "User successfully created Ajo with id of {$newAjo->id}";

    $this->createActivityLog($title,$userActivity,$userId);
    
    return $this->success(
      $newAjo,
      'Ajo has been created successfully!',
      200
    );
  }



  private function generateRandomAlphaNumeric()
  {

    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $code = substr(str_shuffle($permitted_chars), 0, 5);

    $checkAjo = Ajo::where('code', $code)->first();

    if ($checkAjo) {

      $this->generateRandomAlphaNumeric();
    }

    return $code;
  }
}
