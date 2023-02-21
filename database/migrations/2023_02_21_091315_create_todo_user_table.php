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
        Schema::create('todo_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('todo_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todo_user', function (Blueprint $table) {
            $table->dropForeign('todo_user_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('todo_user_todo_id_foreign');
            $table->dropColumn('todo_id');
        });

        Schema::dropIfExists('todo_user');
    }
};
