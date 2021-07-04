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
            $table->bigIncrements('id');
            $table->integer('month');
            $table->integer('year');
            $table->string('full_name');
            $table->date('birthday');
            $table->unsignedBigInteger('department_id');
            $table->string('position');
            $table->enum('type',['rate','hourly payment']);
            $table->double('amount');
            $table->integer('working_hours')->nullable();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
