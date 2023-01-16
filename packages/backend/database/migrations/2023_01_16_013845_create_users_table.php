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
        Schema::create('users', function (Blueprint $table) {
            $table->char('id', 36)->primary()->comment('バックエンドでUUID生成');
            $table->timestamps();
            $table->string('name', 64)->comment('日本語英語問わず64、登録なしはできない');
            $table->string('password', 255)->comment('ハッシュ化前は8文字以上 32文字以下');
            $table->string('email', 255)->unique()->comment('ユーザメールアドレス');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
