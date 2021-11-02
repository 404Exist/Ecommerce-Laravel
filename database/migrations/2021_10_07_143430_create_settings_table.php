<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('email')->nullable();
            $table->string('main_lang')->default('en');
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->longText('message_maintenance')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
