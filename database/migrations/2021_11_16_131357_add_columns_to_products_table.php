<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'materials')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('materials')->default(0);
                $table->integer('labour')->default(0);
                $table->string('global_value_expiry')->nullable();
                $table->integer('product_price')->nullable()->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
