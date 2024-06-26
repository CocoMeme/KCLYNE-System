<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');            
            $table->string('email');
            $table->string('password');
            $table->date('birth_date');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('phone', 20)->nullable();
            $table->bigInteger('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('baranggay')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('customer_image')->nullable();
            $table->enum('status', ['Verified', 'Pending']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
