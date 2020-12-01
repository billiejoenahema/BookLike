<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('screen_name')->unique()->null()->comment('アカウント名');
            $table->string('name')->null()->comment('氏名');
            $table->string('profile_image')->nullable()->default('default_user_icon.jpeg')->comment('プロフィール画像');
            $table->string('description', 255)->nullable()->default('よろしくお願いします！')->comment('自己紹介');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
