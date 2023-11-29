<?php

namespace App\Actions\AjoSystem;

use App\Models\Ajo;
use App\Models\AjoGroups;
use App\Models\AjoUser;
use App\Models\User;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use App\Traits\SmsTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use GuzzleHttp;

class JoinAjoAction
{

  use ApiResponse;
  use EncryptionTrait;
  use ActivityLogTrait;

  protected $group;


  public function joinAjo(array $data)
  {

    $group = Ajo::where('id', $data['group_ajo_id'])->first();



    if (!$group) {
      return $this->error(
        'Cannot Find Ajo!',
        401,
      );
    }



    if ($data['order_no'] > $group->number_of_people) {
      return $this->error(
        'Cannot choose a number higher than the maximum number of members!',

        401,
        ['Total number for Ajo' =>  $group->number_of_people],
      );
    }

    $groupuser = new AjoUser;

    $user = auth()->user();
    $this->user = $user;

    if ($groupuser->where('user_id', $user->id)->where('group_id', $group->id)->exists()) {

      return $this->error(
        'You are already a member of this group!',
        400
      );
    }

    $selected_order_nos = AjoUser::where('group_id', $data['group_ajo_id'])->where('order_no', $data['order_no'])->first();

    if (!$selected_order_nos == null) {
      return $this->error(
        'Selected payout order number already selected. Kindly choose another number!',
        401
      );
    }


    $number = $data['order_no'];

    $ajoGroup = AjoGroups::where('group_id', $data['group_ajo_id'])->first();

    $members = $ajoGroup->members_id;
    array_push($members, $user->id);
    $order_numbers = $ajoGroup->members_order_no;
    array_push($order_numbers, $number);

    $joinedAjoUser = AjoUser::create([
      'user_id' => $user->id,
      'first_name' => $this->user->first_name,
      'group_id' => $group->id,
      // 'is_admin' => false,
      'order_no' => $number,
      'payment_status' => array()
    ]);

    if (!$joinedAjoUser) {
      return $this->error(
        'Could not join Ajo!',
        400,
        $joinedAjoUser
      );
    }

    $ajoGroup->update([
      'members_id' => $members,
      'members_order_no' => $order_numbers
    ]);
    $title = "Joining Ajo";

    $userActivity = "User succesfully joined an Ajo of group id {$group->id}";
    
    $this->createActivityLog($title, $userActivity, auth()->user()->id);

    return $this->success(
      $joinedAjoUser,
      'Joined Ajo successfully!',
      200
    );
  }
}
