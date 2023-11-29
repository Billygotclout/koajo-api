<?php

namespace App\Http\Controllers\Payments;

use App\Actions\AjoSystem\PayAheadAction;
use App\Actions\Payment\ChargeTokenAction;
use App\Actions\Payment\GetCardDetailsAction;
use App\Actions\Payment\VerifyTransactionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\ChargeTokenRequest;
use App\Http\Requests\Payments\VerifyTransactionRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

   public function verifyTransaction(VerifyTransactionRequest $request)
   {

      return (new VerifyTransactionAction)->execute($request->validated());
   }

   public function chargeToken(ChargeTokenRequest $request)
   {
      return (new ChargeTokenAction)->execute($request->validated());
   }

   public function getCardDetails()
   {
      return (new GetCardDetailsAction)->execute();
   }

   public function payAhead()
   {
      return (new PayAheadAction)->execute();
   }
}
