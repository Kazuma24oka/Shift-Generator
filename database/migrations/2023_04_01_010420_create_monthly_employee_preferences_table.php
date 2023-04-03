<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyEmployeePreferencesTable extends Migration
{
    public function up()
    {
        Schema::create('monthly_employee_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('preferred_working_days')->nullable();
            $table->string('preferred_days_off')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('monthly_employee_preferences', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('monthly_employee_preferences');
    }
}