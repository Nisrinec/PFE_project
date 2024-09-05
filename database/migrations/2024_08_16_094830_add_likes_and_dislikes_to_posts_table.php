<?php
// database/migrations/xxxx_xx_xx_add_likes_and_dislikes_to_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesAndDislikesToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('likes_count')->default(0);
            $table->integer('dislikes_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['likes_count', 'dislikes_count']);
        });
    }
}
