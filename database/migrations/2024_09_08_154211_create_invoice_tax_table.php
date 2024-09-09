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
        Schema::create('invoice_tax', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('incomes_id')->index('fk_incomes_invoice_tax1_idx');
            $table->decimal('IRFF_percentage', 10)->nullable();
            $table->decimal('IRFF_amount', 10)->nullable();
            $table->decimal('CSLL_percentage', 10)->nullable();
            $table->decimal('CSLL_amount', 10)->nullable();
            $table->decimal('COFINS_percentage', 10)->nullable();
            $table->decimal('COFINS_amount', 10)->nullable();
            $table->decimal('PIS_percentage', 10)->nullable();
            $table->decimal('PIS_amount', 10)->nullable();
            $table->decimal('tribute_percentage', 10)->nullable();
            $table->decimal('tribute_amount', 10)->nullable();
            $table->boolean('withheld')->nullable()->default(false);
            $table->decimal('money_before_withholding', 10)->nullable()->default(0);
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
        Schema::dropIfExists('invoice_tax');
    }
};
