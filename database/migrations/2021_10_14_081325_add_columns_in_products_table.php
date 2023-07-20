<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'pdf')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('pdf')->nullable();
                $table->string('global_pdf')->nullable();
                $table->integer('value_percentage')->nullable()->default(0);
                $table->enum('value_type', array('Increase', 'Decrease'))->default('Increase');
                $table->integer('global_value_percentage')->nullable()->default(0);
                $table->enum('global_value_type', array('Increase', 'Decrease'))->default('Increase');
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
