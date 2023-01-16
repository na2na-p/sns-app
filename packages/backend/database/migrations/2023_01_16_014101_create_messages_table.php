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
        Schema::create('messages', function (Blueprint $table) {
            $table->char('id', 36)->primary()->comment('バックエンドでUUID生成');
            $table->timestamps();
            $table->text('body')->comment('メッセージ本文');
            // $table->foreignId('user_id')->constrained('users')->comment('ユーザID'); // bigintカラムになるのでNG
            $table->char('user_id', 36)->comment('ユーザID');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};