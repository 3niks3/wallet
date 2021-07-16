<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Wallet;
use App\Service\Format;
use App\Service\TransactionValidationService;
use App\Service\UserValidationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_registration_validation()
    {
        $data = [
            'name' => 'Example User Name',
            'surname' => 'Example User Surname',
            'email' => 'testExampleEmail@exampleTest.test',
            'password' => 'password',
            'password_again' => 'password',
        ];

        $validation = new UserValidationService($data);
        $validationResults = $validation->validate()->getResponse();

        $results = $validationResults['status'];

        $this->assertTrue($results);

    }

    public function test_transaction_create_validation()
    {
        //max available amount in wallet = 100.00
        //transfer amount 100.00

        $wallet = Wallet::factory()->make(['user_id' => null, 'amount' => 10000]);
        $data = ['amount' => Format::formatFormMoney('100'), 'type' => 'out'];


        $validation = new TransactionValidationService($data, $wallet);
        $validationResults = $validation->validate()->getResponse();

        $status = $validationResults['status'];

        $this->assertTrue($status,'Correct amount match max available amount in wallet');

    }


}
