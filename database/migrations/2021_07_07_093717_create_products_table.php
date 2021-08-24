<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('TrackID');
            $table->string('image')->nullable();
            $table->float('price');
            $table->string('color')->nullable();
            $table->string('size') -> nullable();
            $table->string('description');
            $table->float('discount') -> nullable();
            $table->string('model')->nullable();
            $table->integer('status');
            $table->integer('qty');
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
        Schema::dropIfExists('products');
    }
}
