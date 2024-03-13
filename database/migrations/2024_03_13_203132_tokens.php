<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tokens extends Migration
{

    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->dateTime('expiration');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
