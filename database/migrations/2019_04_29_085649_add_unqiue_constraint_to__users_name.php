<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnqiueConstraintToUsersName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //using 'Schema::table()' instead of 'Schema::create()' as we are updating the existing table, not creating a new one
        Schema::table('users', function (Blueprint $table) {
            //add unique constraint
            //'change()' may need to be commented out when creating the database as this only works when updating an existing database
            $table->string('name')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
