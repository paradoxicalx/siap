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
            $table->string('name');
            $table->string('username', 12)->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->longText('address')->nullable();
            $table->enum('role', ['admin', 'partner', 'customer'])->default('customer');
            $table->decimal('wallet', 10, 0)->default(0);
            $table->longText('notes')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
        });
        DB::update("ALTER TABLE users AUTO_INCREMENT = 190600;");
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
