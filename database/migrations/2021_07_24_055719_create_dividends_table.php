<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDividendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ['company', 'announced', 'interim', 'final_div', 'total_div', 'bonus', 'closure_date', 'agm', 'payment_d', 'quali_date'];
        Schema::create('dividends', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->date('announced');
            $table->integer('interim');
            $table->double('final_div');
            $table->double('total_div');
            $table->string('bonus');
            $table->date('closure_date');
            $table->date('agm');
            $table->date('payment_d');
            $table->date('quali_date');

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
        Schema::dropIfExists('dividends');
    }
}