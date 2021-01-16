<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingsSpoilerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedTinyInteger('ratings')->default('3')->after('image_url')->comment('おすすめ度');
            $table->unsignedTinyInteger('spoiler')->default('0')->after('ratings')->comment('ネタバレ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('ratings');
            $table->dropColumn('spoiler');
        });
    }
}
