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
            if (!Schema::hasColumn('applications', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('applications', 'sex')) {
                $table->string('sex');
            }
            if (!Schema::hasColumn('applications', 'birthdate')) {
                $table->date('birthdate');
            }
            if (!Schema::hasColumn('applications', 'address')) {
                $table->string('address');
            }
            if (!Schema::hasColumn('applications', 'school')) {
                $table->string('school');
            }
            if (!Schema::hasColumn('applications', 'phone')) {
                $table->string('phone');
            }
            if (!Schema::hasColumn('applications', 'email')) {
                $table->string('email');
            }
            if (!Schema::hasColumn('applications', 'time')) {
                $table->string('time');
            }
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
