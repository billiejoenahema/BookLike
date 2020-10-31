<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->char('asin', 10)->comment('ASIN');
            $table->string('page_url')->nullable()->comment('商品ページ');
            $table->string('title')->comment('タイトル');
            $table->string('author')->nullable()->comment('著者');
            $table->string('manufacturer')->nullable()->comment('出版社');
            $table->string('image_url')->nullable()->comment('イメージURL');
            $table->text('text')->comment('本文');
            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
            $table->index('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
