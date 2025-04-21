<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::table('applications', function (Blueprint $table) {
            $table->string('name');
            $table->string('sex');
            $table->date('birthdate');
            $table->string('address');
            $table->string('school');
            $table->string('phone');
            $table->string('email');
            $table->string('time');
        });
    }

    public function down(){
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'sex',
                'birthdate',
                'address',
                'school',
                'phone',
                'email',
                'salary',
                'time',
            ]);
        });
    }

};
