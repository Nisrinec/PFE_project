<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Check if columns do not already exist before adding them
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->after('id');
            }
            if (!Schema::hasColumn('notifications', 'notifiable_id')) {
                $table->unsignedBigInteger('notifiable_id')->after('type');
            }
            if (!Schema::hasColumn('notifications', 'notifiable_type')) {
                $table->string('notifiable_type')->after('notifiable_id');
            }
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->after('notifiable_type');
            }
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable()->after('data');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop columns in reverse order to avoid dependency issues
            $table->dropColumn(['type', 'notifiable_id', 'notifiable_type', 'data', 'read_at']);
        });
    }
}
