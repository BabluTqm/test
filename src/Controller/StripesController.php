<?php

namespace App\Controller;

use Cake\View\ViewBuilder;
use Stripe;

class StripesController extends AppController

{
    // public function stripe()
    // {
    //     $this->set("title", "Stripe Payment Gateway Integration");
    //     $this->viewBuilder()->setLayout('admin_login');
    // }

    /* public function payment()
    {
        $this->loadModel('ContractorCredit');
        $debit = 100;
        $id = $_GET['id'];
        //dd($id);
        $total_balance = $this->ContractorCredit->find('all')->where(['user_id' => $id]);
        // dd($total_balance);
        require_once VENDOR_PATH . '/stripe/stripe-php/init.php';

        Stripe\Stripe::setApiKey(STRIPE_SECRET);
        $stripe = Stripe\Charge::create([
            "amount" => 1 * 100,
            "currency" => "usd",
            "source" => $_REQUEST["stripeToken"],
            "description" => "Test payment via Stripe From onlinewebtutorblog.com"
        ]);
        // dd($stripe);
        // after successfull payment, you can store payment related information into your database
        $this->Flash->success(__('Payment done successfully'));

        return $this->redirect(['controller' => 'users', 'action' => 'dashboard']);
    }
*/

    public function payment()
    {
        $this->loadModel('Transaction');
        $this->loadModel('ContractorCredit');

        if ($_POST['tokenId']) {
            require_once('vendor/autoload.php');
            //stripe secret key or revoke key
            $stripeSecret = 'sk_test_j5k0976GOLSOtiRzbDLpKqat00og5iM3cY';
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey($stripeSecret);
            // Get the payment token ID submitted by the form:
            $token = $_POST['tokenId'];
            // Charge the user's card:
            $charge = \Stripe\Charge::create(array(
                "amount" => $_POST['amount'],
                "currency" => "usd",
                "description" => "CLMS Lead Payment",
                "source" => $token,
            ));
            // after successfull payment, you can store payment related information into your database
            $data = array('success' => true, 'data' => $charge);
            // dd($data);
            $my = array();
            $id =  $this->Authentication->getIdentity()->id;

            $my['user_id'] = $id;
            $my['amount'] = $data['data']['amount'];
            $my['transaction_id'] = $data['data']['id'];

            $transaction = $this->Transaction->newEmptyEntity();
            $transaction = $this->Transaction->patchEntity($transaction, $my);

            $current_amount  = $this->Transaction->save($transaction);
            $total_credit = $this->ContractorCredit->find('all')->where(['user_id' => $id])->first();

            $total_credit->total_credit = $total_credit->total_credit + $current_amount->amount;

            if ($this->Transaction->save($transaction)) {
                $this->ContractorCredit->save($total_credit);
                echo json_encode($data);
                exit;
            }
            // print_r($transaction);
            // die;
            // echo json_encode($data);
            // exit;
        }
    }
}
