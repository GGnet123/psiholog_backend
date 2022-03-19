<?php
namespace App\Http\Controllers\Admin\Sample;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CloudPaymentController extends Controller {
    function index(Request $request){
        if (count($request->all()))
            return $this->checkSecure($request);

        return view(
            'sample.cloud_pay'
        );
    }

    private function checkSecure(Request $request){
        $array = [
            'TransactionId' => $request->MD,
            'PaRes' => $request->PaRes
        ];

        // Trying to do Payment
        try {
            $result = CloudPay::cardsPost3ds($array);

            dd($result, 2221);
        } catch  (\Exception $e) {
            $result = $e->getMessage();
        }
    }

    function token(){
        $array = [
            'Amount' => 100, // Required
            'Currency' => 'KZT', // Required
            'Name' => 'dddd', // Required
            'IpAddress' => '212.154.193.105', // Required
            'Token' => config('cloudpayments.Token'), // Required
            'InvoiceId' => 1,
            'Description' => 'Payment for order №' . 1,
            'AccountId' => '999',
            'Email' => 'zgqjgaczb@supere.ml',
            'JsonData' => json_encode([
                'middleName' => 'dd',
                'lastName' => 'dddd'
            ]),
        ];

        // Trying to do Payment
        try {
            $result = CloudPay::tokensCharge($array);

            dd($result, 1, config('cloudpayments.test_crypto'));
        } catch (\Exception $e) {
            $result = $e->getMessage();
            dd($result);
        }
    }

    function charge(){
        $array = [
            'Amount' => 10, // Required
            'Currency' => 'RUB', // Required
            'Name' => 'dddd', // Required
            'IpAddress' => '212.154.193.105', // Required
            'CardCryptogramPacket' => config('cloudpayments.test_crypto_with_3d'), // Required
            'InvoiceId' => 1,
            'Description' => 'Payment for order №' . 1,
            'AccountId' => '999',
            'Email' => 'zgqjgaczb@supere.ml',
            'JsonData' => json_encode([
                'middleName' => 'dd',
                'lastName' => 'dddd'
            ]),
        ];

        // Trying to do Payment
        try {
            $result = CloudPay::cardsCharge($array);

            dd($result, 1, config('cloudpayments.test_crypto'));
        } catch (\Exception $e) {
            $result = $e->getMessage();
            dd($result);
        }
    }

    function secure(){
        return view(
            'sample.cloud_pay_secure'
        );
    }


    function chargefree(){
        $array = [
            'Amount' => 10, // Required
            'Currency' => 'RUB', // Required
            'Name' => 'dddd', // Required
            'IpAddress' => '212.154.193.105', // Required
            'CardCryptogramPacket' => config('cloudpayments.test_crypto_without3d'), // Required
            'InvoiceId' => 1,
            'Description' => 'Payment for order №' . 1,
            'AccountId' => '999',
            'Email' => 'zgqjgaczb@supere.ml',
            'JsonData' => json_encode([
                'middleName' => 'dd',
                'lastName' => 'dddd'
            ]),
        ];

        // Trying to do Payment
        try {
            $result = CloudPay::cardsCharge($array);

            dd($result, 1, config('cloudpayments.test_crypto'));
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }
    }

    function returnPay(){
        try {
            $result = CloudPay::transactionsVoid('1060026500');

            dd($result, 1, config('cloudpayments.test_crypto'));
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }
    }

    function transactionsRefund(){
        try {
            $result = CloudPay::transactionsRefund(['TransactionId' => '1060026500', 'Amount' => '10']);

            dd($result, 1, config('cloudpayments.test_crypto'));
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

    }

}
