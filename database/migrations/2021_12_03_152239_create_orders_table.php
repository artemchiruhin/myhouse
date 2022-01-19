<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('cost')->unsigned();
            $table->foreignId('status_id')->default(1)->references('id')->on('statuses');
            $table->date('date_from');
            $table->date('date_to');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
