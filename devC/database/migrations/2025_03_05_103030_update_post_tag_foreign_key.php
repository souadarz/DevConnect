<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['post_id']);

            // Recreate the foreign key with ON DELETE CASCADE
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            // Rollback: Drop the new constraint
            $table->dropForeign(['post_id']);

            // Recreate the old foreign key (without cascade)
            $table->foreign('post_id')
                ->references('id')
                ->on('posts');
        });
    }
};
