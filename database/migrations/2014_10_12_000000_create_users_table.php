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

            $table->id(); // Primary key
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->unique()->nullable();
            $table->decimal('salary', 10, 2)->nullable(); // Only for employees
            $table->enum('role', ['employee', 'manager', 'admin'])->default('employee'); // User roles
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // Self-reference
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('restrict'); // Department relation
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
