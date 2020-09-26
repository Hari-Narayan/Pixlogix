<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('dailing_code', 10);
            $table->string('mobile_number', 20);
            $table->string('password', 200);
            $table->tinyInteger('gender')->comment('1 - Male / 2 - Female / 0 - Other');
            $table->string('profile_photo', 100);
            $table->integer('role_id')->unsigned();
            $table->tinyInteger('is_email_verified')->default(0)->comment('1 - Yes / 0 - No / Default - 0');
            $table->tinyInteger('status')->default(1)->comment('1 - Active / 0 - Inactive / Default - 1');
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('last_active_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function($table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}