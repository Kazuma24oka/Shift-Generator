<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('preferred_working_days')->nullable();
            $table->string('preferred_days_off')->nullable();
            $table->integer('min_working_days');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('preferred_store_id');
            $table->unsignedBigInteger('incompatible_employee_id')->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('preferred_store_id')->references('id')->on('stores');
            $table->foreign('incompatible_employee_id')->references('id')->on('employees');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropForeign(['preferred_store_id']);
            $table->dropForeign(['incompatible_employee_id']);
        });
        Schema::dropIfExists('employees');
    }
}