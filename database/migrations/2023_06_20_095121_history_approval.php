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
        Schema::create('history_approval', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contractvendor_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->text('notes');
            $table->foreign('contractvendor_id')->references('id')->on('contract_vendor');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
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
