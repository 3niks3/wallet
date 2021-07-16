<?php
namespace App\Service;

use App\Models\Transaction;
use App\Rules\AmountCheck;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class TransactionValidationService
{
    Const MAX_TRANSFER_AMOUNT = 500000;//amount in cents

    public $data;
    public $wallet;
    public $rules;

    public $fails = false;
    public $errors = [];

    public function __construct($data, $wallet = null)
    {
        $this->data = $data;
        $this->wallet = $wallet;

        $this->rules = [
            'amount' => ['required', 'numeric','max:'.self::MAX_TRANSFER_AMOUNT, 'gt:0']
        ];
    }

    public function validate()
    {
        switch(true)
        {
            case(empty($this->data['type']??null) || !in_array($this->data['type'],['in', 'out'])):
                $this->fails = true;
                $this->errors = ['Incorrect transaction type'];
                return $this;
                break;
            case($this->data['type'] == 'in'):
                return $this->validateIncomingTransaction();
                break;
            case($this->data['type'] == 'out'):
                return $this->validateOutgoingTransaction();
                break;
            default:
                $this->fails = true;
                $this->errors = ['Unknown transaction type'];
                return $this;
                break;
        }
    }

    private function validateIncomingTransaction()
    {
        $rules = $this->rules;

        $validator = \Validator::make($this->data, $rules);

        $this->fails = $validator->fails();
        $this->errors = $validator->messages()->getMessages();

        return $this;
    }

    private function validateOutgoingTransaction()
    {
        $rules = $this->rules;

        $validator = \Validator::make($this->data,$rules);

        $this->fails = $validator->fails();
        $this->errors = $validator->messages()->getMessages();


        if($this->data['amount'] > $this->wallet->amount) {
            $this->fails = true;
            $this->errors['amount'] = 'Outgoing transaction amount can not be more then amount in wallet ('.$this->wallet->amount_number_format.')';
        }

        return $this;
    }

    public function getResponse($messageFlat = false)
    {
        $messages = $this->errors;

        if($messageFlat) {
            $messages = Arr::flatten($messages);
        }

        return ['status' => !$this->fails, 'messages' => $messages];
    }
}
