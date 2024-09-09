<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('fixed_payment_id')->nullable();
            $table->string('expense_name', 200);
            $table->char('fixed_payment', 1)->nullable()->default('0');
            $table->date('due_date');
            $table->date('date_payed')->nullable();
            $table->string('obs', 200);
            $table->char('repeat', 2)->nullable()->default('0');
            $table->decimal('amount', 10);
            $table->integer('category_id')->index('fk_expenses_expenses_categories1_idx');
            $table->integer('times_installments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
