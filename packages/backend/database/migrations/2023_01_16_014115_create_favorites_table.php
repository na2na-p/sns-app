<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', static function (Blueprint $table) {
            $table->char('id', 36)->primary()->comment('バックエンドでUUID生成');
            $table->timestamps();
            $table->char('user_id', 36)->comment('ユーザID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->char('message_id', 36)->comment('メッセージID');
            $table->foreign('message_id')->references('id')->on('messages');
            $table->unique(['user_id', 'message_id'])->comment('単一ユーザーは同じメッセージに複数Favできない');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
