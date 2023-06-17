<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_vendor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('number');
            $table->string('director');
            $table->string('address');
            $table->string('phone');
            $table->string('filename');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('contract_id')->references('id')->on('contracts');
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
        //
    }
};
