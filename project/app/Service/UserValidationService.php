<?php
namespace App\Service;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UserValidationService
{
    public $data;
    public $generalValidationRules;

    public function __construct($data)
    {
        $this->data = $data;
        $this->generalValidationRules = [
            'name' => 'required|min:1|max:255',
            'surname' => 'nullable|max:255',
            'email' => 'required|email|min:3|max:255|unique:user,email',
            'password' => 'required|min:6|max:32|',
            'password_again' => 'required_with:password|same:password',
        ];
    }

    public function validate()
    {
        $rules = $this->generalValidationRules;
        $validator = \Validator::make($this->data, $rules);

        if($validator->fails()) {
            return ['status' => false, 'messages' => $validator->messages()->getMessages()] ;
        }

        return ['status' => true, 'messages' => [] ];
    }

}
