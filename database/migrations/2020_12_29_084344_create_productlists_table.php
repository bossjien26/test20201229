<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product');
            $table->string('oprice');
            $table->string('sprice');
            $table->string('Vendor');
            $table->string('image');
            $table->text('produce');
            $table->string('add_time')->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productlists');
    }
}
