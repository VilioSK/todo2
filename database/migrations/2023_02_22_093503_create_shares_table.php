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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('todo_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shares', function (Blueprint $table) {
            $table->dropForeign('shares_owner_id_foreign');
            $table->dropColumn('owner_id');
            $table->dropForeign('shares_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('shares_todo_id_foreign');
            $table->dropColumn('todo_id');
        });

        Schema::dropIfExists('shares');
    }
};
