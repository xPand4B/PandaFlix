<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->date('birthday');
            $table->string('avatar')->nullable();
            $table->string('locale')->default(config('app.local'));

            $table->string('password');
            $table->string('api_token');
            $table->rememberToken();

            $table->timestampTz('email_verified_at')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
