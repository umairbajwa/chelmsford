<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->string('first');
            $table->string('last');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('town');
            $table->string('postcode');
            $table->text('quote_data');
            $table->text('quoted_products');
            $table->integer('followed_up')->default(0);
            $table->integer('won')->default(0);
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
        Schema::dropIfExists('quotes');
    }
}
