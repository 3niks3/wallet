<?php
namespace App\Service;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UserValidationService
{
    public $data;
    public $rules;

    public $fails = false;
    public $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
        $this->rules = [
            'name' => 'required|min:1|max:255',
            'surname' => 'nullable|max:255',
            'email' => 'required|email|min:3|max:255|unique:user,email',
            'password' => 'required|min:6|max:32|',
            'password_again' => 'required_with:password|same:password',
        ];
    }

    public function validate()
    {
        $rules = $this->rules;
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
