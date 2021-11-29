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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_website')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phonenumber')->unique()->nullable();
            $table->set('roles', [Config::get('constants.roles.ADMIN_ROLE'), Config::get('constants.roles.USER_ROLE')])
                    ->default(Config::get('constants.roles.USER_ROLE'));
            $table->string('institution_name');
            $table->string('institution_url')->nullable();
            $table->string('institution_street')->nullable();
            $table->string('institution_zipcode')->nullable();
            $table->string('institution_city')->nullable();
            $table->string('institution_country')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
