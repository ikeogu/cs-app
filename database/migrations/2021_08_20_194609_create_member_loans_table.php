<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_loans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('amount');
            $table->string('reciept')->nullable();
            $table->string('paid_via')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('loan_id');
            $table->integer('status');
            $table->double('payback');
            $table->string('duration');
            $table->string('gcode');
            $table->string('code')->nullable();
            $table->float('intrest');



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
        Schema::dropIfExists('member_loans');
    }
}