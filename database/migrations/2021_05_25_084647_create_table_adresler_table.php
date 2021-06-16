<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdreslerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresler', function (Blueprint $table) {
            $table->id("Adres_no");
            $table->string("Cadde");
            $table->string("Mahalle");
            $table->string("Bina_no");
            $table->string("Sehir");
            $table->integer("Posta_kodu");
            $table->string("Ulke");
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
        Schema::dropIfExists('adresler');
    }
}
