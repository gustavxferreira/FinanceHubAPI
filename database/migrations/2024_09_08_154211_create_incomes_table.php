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
        Schema::create('incomes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('incomes_name', 200);
            $table->decimal('amount', 10);
            $table->date('due_date');
            $table->date('issue_date');
            $table->date('date_received')->nullable();
            $table->string('obs', 200)->nullable();
            $table->decimal('tax_amount', 10);
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
        Schema::dropIfExists('incomes');
    }
};
