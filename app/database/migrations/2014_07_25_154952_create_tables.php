<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        // one-to-many relationship beween users and tasks
        // A user has many tasks
        // A given task is associated with atmost one user
        //
        Schema::create('users', function($table) {

            # AI, PK
            $table->increments('id');

            # created_at, updated_at columns
            $table->timestamps();

            #General Data
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->boolean('remember_token');
            $table->string('password');

            # Define Foreign keys
            # none needed
        });

        Schema::create('tasks', function($table) {

            # AI, PK
            $table->increments('id');

            # created_at, updated_at columns
            $table->timestamps();

            #General Data
            $table->text('description');
            $table->dateTime('due_date');
            $table->dateTime('completion_date');
            $table->string('status');

            # Define Foreign keys
            # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
            # Foreign key field
            $table->integer('user_id')->unsigned();
            # Set the foreign key relationship
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('tasks');
        Schema::drop('users');
	}

}
