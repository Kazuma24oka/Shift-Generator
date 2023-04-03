<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkingDaysToMonthlyEmployeePreferencesTable extends Migration
{
    public function up()
    {
        Schema::table('monthly_employee_preferences', function (Blueprint $table) {
            $table->string('preferred_working_days')->nullable();
            $table->string('preferred_days_off')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('monthly_employee_preferences', function (Blueprint $table) {
            $table->dropColumn('preferred_working_days');
            $table->dropColumn('preferred_days_off');
        });
    }
}
