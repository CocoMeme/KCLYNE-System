<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('phone', 20)->nullable();
            $table->bigInteger('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('baranggay')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('position')->nullable();
            $table->bigInteger('payrate_per_hour')->nullable();
            $table->string('employee_image')->nullable();
<<<<<<< HEAD
            $table->softDeletes();
=======
            $table->enum('status', ['Verified', 'Pending']);
>>>>>>> 5e00c6f10062c08078c383906326710e36d7de31
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
