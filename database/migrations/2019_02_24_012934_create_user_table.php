<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)
                ->comment('User email')
                ->unique();
            $table->string('password', 255)
                ->nullable()
                ->comment('User password');
            $table->enum('type', ['role1', 'role2'])
                ->default('role2')
                ->comment('Type of user');
            $table->string('chash', 160)
                ->index('chash')
                ->nullable()
                ->comment('Password change hash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
