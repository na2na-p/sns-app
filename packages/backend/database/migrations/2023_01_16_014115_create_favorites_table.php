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
        Schema::create('favorites', function (Blueprint $table) {
            $table->char('id', 36)->primary()->comment('バックエンドでUUID生成');
            $table->timestamps();
            // $table->foreignId('user_id')->constrained('users')->comment('ユーザID');
            // $table->foreignId('message_id')->constrained('messages')->comment('メッセージID');
            $table->char('user_id', 36)->comment('ユーザID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->char('message_id', 36)->comment('メッセージID');
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};