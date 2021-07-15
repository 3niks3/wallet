<?php
namespace App\Service;

use App\Models\Transaction;
use App\Rules\AmountCheck;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class TransactionValidationService
{
    public $data;
    public $wallet;
    public $generalValidationRules = ['required', 'numeric','max:5000', 'gt:0'];

    public function __construct($data, $wallet = null)
    {
        $this->data = $data;
        $this->wallet = $wallet;
    }

    public function validate()
    {
        switch(true)
        {
            case(empty($this->data['type']??null) || !in_array($this->data['type'],['in', 'out'])):
                return ['status' => false, 'messages' => ['Incorrect transaction type']];
                break;
            case($this->data['type'] == 'in'):
                return $this->validateIncomingTransaction();
                break;
            case($this->data['type'] == 'out'):
                return $this->validateOutgoingTransaction();
                break;
            default:
                return ['status' => false, 'messages' => ['Unknown transaction type']];
                break;
        }
    }

    private function validateIncomingTransaction()
    {
        $rules = $this->generalValidationRules;

        $validator = \Validator::make(request()->all(), [
            'amount' => $rules,
        ]);

       return $this->formatResponse($validator);
    }

    private function validateOutgoingTransaction()
    {
        $rules = $this->generalValidationRules;

        $validator = \Validator::make(request()->all(), [
            'amount' => $rules,
        ]);

        $amount = Format::formatFormMoney($this->data['amount']);
        $failedManually = false;

        if($amount > $this->wallet->amount) {
            $failedManually = true;
            $validator->messages()->add('amount','Outgoing transaction amount can not be more then amount in wallet ('.$this->wallet->amount_number_format.')');
        }

        return $this->formatResponse($validator, $failedManually);
    }

    private function formatResponse($validator, $failedManually = false)
    {
        if($failedManually || $validator->fails() ) {
            return ['status' => false, 'messages' => $validator->messages()->getMessages()] ;
        }

        return ['status' => true, 'messages' => [] ];
    }
}
