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
        Schema::create('pix', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name_pix', 200);
            $table->decimal('amount', 10);
            $table->dateTime('date_received')->nullable();
            $table->string('obs', 150)->nullable();
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
        Schema::dropIfExists('pix');
    }
};
