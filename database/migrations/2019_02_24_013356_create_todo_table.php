<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('todo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned()
                ->comment('Related user')
                ->index();
            $table->text('plan')
                ->comment('What was planned');
            $table->boolean('completed')
                ->default(false)
                ->comment('Is this plan completed?');
            $table->timestamps();

            $table
                ->foreign('user_id', 'todo_uid_fk')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('todo');
        Schema::enableForeignKeyConstraints();
    }
}
