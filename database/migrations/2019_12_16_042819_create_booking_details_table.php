<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('num_rooms');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->ondelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
