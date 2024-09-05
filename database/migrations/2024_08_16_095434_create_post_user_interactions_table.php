<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserInteractionsTable extends Migration
{
    public function up()
    {
        Schema::create('post_user_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('liked')->default(false);
            $table->boolean('disliked')->default(false);
            $table->timestamps();

            // Add a unique constraint on the combination of post_id and user_id
            $table->unique(['post_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_user_interactions');
    }
}
