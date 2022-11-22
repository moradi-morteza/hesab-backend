<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeSpatieRolePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string("fa_name")->nullable();
            $table->string("des")->nullable();
        });

        Schema::create('permission_parent', function (Blueprint $table) {
            $table->id("id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string("fa_name")->nullable();
            $table->string("parent_id")->default(0);
            $table->string("payload")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('fa_name');
            $table->dropColumn('des');
        });

        Schema::table('permission_parent', function (Blueprint $table) {
            $table->dropColumn("name");
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn("fa_name");
            $table->dropColumn("parent_id");
        });

    }
}
