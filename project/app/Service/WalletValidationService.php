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
    public $generalValidationRules = ['required','max:50'];

    public function __construct($data, $action, $user, $wallet = null, $additionalRules = [])
    {
        $this->data = $data;
        $this->action = $action;
        $this->user = $user;
        $this->wallet = $wallet;
        $this->generalValidationRules = array_merge($this->generalValidationRules, $additionalRules);
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
                return ['status' => false, 'messages' => ['Action are incorrect']];
                break;
        }
    }

    private function validateCreateWallet()
    {
        $rules = $this->generalValidationRules;
        $rules[] = Rule::unique('wallet','name')->where('user_id', $this->user->id);

        $validator = \Validator::make(request()->all(), [
            'name' => $rules,
        ]);

       return $this->formatResponse($validator);
    }

    private function validateUpdateWallet()
    {
        $rules = $this->generalValidationRules;
        $rules[] = Rule::unique('wallet','name')->where('user_id', $this->user->id)->ignore($this->wallet);

        $validator = \Validator::make(request()->all(), [
            'name' => $rules,
        ]);

        return $this->formatResponse($validator);
    }

    private function formatResponse($validator)
    {
        $messages = Arr::flatten($validator->messages()->getMessages());

        if($validator->fails()) {
            return ['status' => false, 'messages' => $messages] ;
        }

        return ['status' => true, 'messages' => [] ];
    }
}
