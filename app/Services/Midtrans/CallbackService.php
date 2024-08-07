<?php

namespace App\Services\Midtrans;

use App\Models\Transaction;
use App\Services\Midtrans\Midtrans;
use Midtrans\Notification;

class CallbackService extends Midtrans
{
    protected $notification;
    protected $Transaction;
    protected $serverKey;

    public function __construct()
    {
        parent::__construct();

        $this->serverKey = config('midtrans.serverKey');
        // $this->_handleNotification();
    }

    public function isSignatureKeyVerified()
    {
        return ($this->_createLocalSignatureKey() == $this->notification->signature_key);
    }

    public function isSuccess()
    {
        $statusCode = $this->notification->status_code;
        $transactionStatus = $this->notification->transaction_status;
        $fraudStatus = !empty($this->notification->fraud_status) ? ($this->notification->fraud_status == 'accept') : true;

        return ($statusCode == 200 && $fraudStatus && ($transactionStatus == 'capture' || $transactionStatus == 'settlement'));
    }

    public function isExpire()
    {
        return ($this->notification->transaction_status == 'expire');
    }

    public function isCancelled()
    {
        return ($this->notification->transaction_status == 'cancel');
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getTransaction()
    {
        return $this->Transaction;
    }

    protected function _createLocalSignatureKey()
    {
        $TransactionId = $this->Transaction->number;
        $statusCode = $this->notification->status_code;
        $grossAmount = $this->Transaction->total_price;
        $serverKey = $this->serverKey;
        $input = $TransactionId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        return $signature;
    }

    // protected function _handleNotification()
    // {
    //     $notification = new Notification();

    //     $TransactionNumber = $notification->Transaction_id;
    //     $Transaction = Transaction::where('number', $TransactionNumber)->first();

    //     $this->notification = $notification;
    //     $this->Transaction = $Transaction;
    // }
}
