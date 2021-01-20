<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unsignedBigInteger('job_status_id')->nullable();
            $table->foreign('job_status_id')->references('id')->on('job_status');
            $table->unsignedBigInteger('working_status_id')->nullable();
            $table->unsignedBigInteger('late_reason_id')->nullable();
            $table->unsignedBigInteger('direct_manager_id')->nullable();
            $table->unsignedBigInteger('position_concurrently_id')->nullable();
            $table->string('employee_code', 255);
            $table->string('full_name', 255);
            $table->string('email', 255);
            $table->date('birth_day')->nullable();
            $table->string('identification_number', 255)->nullable();
            $table->date('identification_date')->nullable();
            $table->string('identification_place_of', 255)->nullable();
            $table->string('tax_code', 255)->nullable();
            $table->string('permanent_address', 255)->nullable();
            $table->string('temporary_address', 255)->nullable();
            $table->string('bank_number', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('bank_user_name', 255)->nullable();
            $table->string('bank_branch', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('chatwork_account', 255)->nullable();
            $table->string('skype_account', 255)->nullable();
            $table->string('facebook_link', 255)->nullable();
            $table->string('personal_email', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('japanese_certificate', 255)->nullable();
            $table->date('update_date')->nullable();
            $table->date('check_in_date')->nullable();
            $table->date('training_date')->nullable();
            $table->date('official_date')->nullable();
            $table->text('contact_user')->nullable();
            $table->string('distance', 255)->nullable();
            $table->tinyInteger('gender');
            $table->date('check_out_date')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
