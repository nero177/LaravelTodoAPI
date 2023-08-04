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
            $table->boolean('done')->default(false);
            $table->smallInteger('priority')->default(1);
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('completed_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('parent_todo_id')->nullable();
            $table->foreign('parent_todo_id')->references('id')->on('todos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
