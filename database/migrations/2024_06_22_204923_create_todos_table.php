<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id(); // id field
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user_id field
            $table->string('title'); // title field
            $table->text('description')->nullable(); // description field
            $table->date('due_date')->nullable(); // due_date field
            $table->enum('completion_status', ['0', '1'])->default('0'); // completion_status field with enum
            $table->text('comments')->nullable(); // comments field
            $table->timestamps(); // created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
