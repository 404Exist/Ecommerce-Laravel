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
            $table->longText('content');
            $table->string('photo')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('trademark_id')->nullable();
            $table->foreign('trademark_id')->references('id')->on('trademarks')->onDelete('cascade');

            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');

            // $table->unsignedBigInteger('mall_id')->nullable();
            // $table->foreign('mall_id')->references('id')->on('malls')->onDelete('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

            $table->string('size')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('countries');

            $table->decimal('price', 5)->default(0);

            $table->integer('stock')->default(0);

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->decimal('offer_price', 5)->default(0);

            $table->longText('mall_id')->default('{}');
            $table->longText('other_data')->default('{}');

            $table->string('weight')->nullable();
            $table->unsignedBigInteger('weight_id')->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');

            $table->enum('status', ['pending', 'rejected', 'active'])->default('pending');
            $table->longText('reason')->nullable();

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
