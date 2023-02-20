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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('category_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->string('name');
            $table->text('description');
            $table->boolean('finished');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign('todos_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('todos_category_id_foreign');
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('todos');        
    }
};
