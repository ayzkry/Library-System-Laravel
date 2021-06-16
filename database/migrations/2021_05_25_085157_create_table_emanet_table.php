<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmanetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emanet', function (Blueprint $table) {
            $table->id("Emanet_no");
            $table->string("ISBN");
            $table->bigInteger("uye_no");
            $table->bigInteger("kutuphane_no");
            $table->dateTime("emanet_tarihi");
            $table->dateTime("teslim_tarihi");
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
        Schema::dropIfExists('emanet');
    }
}
