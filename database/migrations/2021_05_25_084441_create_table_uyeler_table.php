<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUyelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uyeler', function (Blueprint $table) {
            $table->id("Uye_no");
            $table->string("Uye_adi");
            $table->string("Uye_soyadi");
            $table->tinyInteger("cinsiyet");
            $table->string("telefon");
            $table->string("eposta");
            $table->bigInteger("adres_no")->nullable();
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
        Schema::dropIfExists('uyeler');
    }
}
