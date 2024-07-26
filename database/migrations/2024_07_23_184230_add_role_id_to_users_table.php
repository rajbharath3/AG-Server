<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_add_role_id_to_users_table.php
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role_id column and set up foreign key constraint
            $table->unsignedBigInteger('role_id')->after('id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
            // Drop the foreign key and column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
