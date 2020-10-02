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

            $table->string('name', 191);
            $table->string('surname', 191)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();

            # IP data of user
            $table->string('ip')->nullable()->default(null)->comment('User registration ip');
            $table->string('last_login_ip')->nullable()->comment('Last ip user got loggedin from');
            $table->datetime('last_login_at')->nullable()->comment('time when user was last loggedin');

            # Impersonatro data
            $table->boolean('is_admin')->default(0)->index();
            $table->boolean('can_be_impersonated')->default(1)->index();

            // user account status
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(true);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
}
