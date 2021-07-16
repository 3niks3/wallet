<?php
namespace App\Service;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class WalletValidationService
{
    public $data;
    public $action;
    public $user;
    public $wallet;
    public $rules;

    public $fails = false;
    public $errors = [];

    public function __construct($data, $action, $user, $wallet = null)
    {
        $this->data = $data;
        $this->action = $action;
        $this->user = $user;
        $this->wallet = $wallet;
        $this->rules =  [
            'name' => ['required','max:50']
        ];
    }

    public function validate()
    {
        switch(true)
        {
            case($this->action == 'create'):
                return $this->validateCreateWallet();
                break;
            case($this->action == 'update'):
                return $this->validateUpdateWallet();
                break;
            default:
                $this->fails = true;
                $this->errors = ['Action are incorrect'];
                return $this;
                break;
        }
    }

    private function validateCreateWallet()
    {
        $rules = $this->rules;
        $rules['name'][] = Rule::unique('wallet','name')->where('user_id', $this->user->id);

        $validator = \Validator::make($this->data,$rules);

        $this->fails = $validator->fails();
        $this->errors = $validator->messages()->getMessages();

        return $this;
    }

    private function validateUpdateWallet()
    {
        $rules = $this->rules;
        $rules['name'][] = Rule::unique('wallet','name')->where('user_id', $this->user->id)->ignore($this->wallet);

        $validator = \Validator::make($this->data, $rules);

        $this->fails = $validator->fails();
        $this->errors = $validator->messages()->getMessages();

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
