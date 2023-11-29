<?php 

namespace App\Traits;

use Crypt; 

trait EncryptionTrait
{

    public function encrypt($id){
        return Crypt::encrypt($id);
    }

    public function decrypt($id){
        return Crypt::decrypt($id);
    }

   
}