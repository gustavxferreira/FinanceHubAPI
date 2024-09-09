<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ExpenseControllerTest extends TestCase
{

    use DatabaseTransactions;

    public function testStoreExpenseSuccess()
    {
        $data =
            [
                "fixed_payment_id" => null,
                "expense_name" => "testeApi",
                "fixed_payment" => null,
                "due_date" => "2024-01-01",
                "date_payed" => null,
                "obs" => "teste Api",
                "repeat" => null,
                "amount" => 999.99,
                "category_id" => 1,
                "times_installments" => null
            ];


        $response = $this->postJson('/api/despesas', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'Message' => 'Expense registered successfully',
            ]);

        $this->assertDatabaseHas('expenses', $data);
    }
}
