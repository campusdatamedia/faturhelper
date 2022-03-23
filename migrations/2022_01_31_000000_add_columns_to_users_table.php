<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users', 'role_id')) {
                $table->integer('role_id')->after('id');
            }
            if(!Schema::hasColumn('users', 'username')) {
                $table->string('username')->after('name');
            }
            if(!Schema::hasColumn('users', 'last_visit')) {
                $table->timestamp('last_visit')->after('remember_token')->nullable();
            }
            if(!Schema::hasColumn('users', 'status')) {
                $table->integer('status')->after('remember_token');
            }
            if(!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->after('remember_token')->nullable();
            }
            if(!Schema::hasColumn('users', 'access_token')) {
                $table->string('access_token')->after('remember_token')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}