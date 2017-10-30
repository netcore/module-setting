<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasManagerFieldToNetcoreSettingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('netcore_setting__settings', function (Blueprint $table) {
            $table->boolean('has_manager')->default(0)->after('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('netcore_setting__settings', function (Blueprint $table) {
            $table->dropColumn('has_manager');
        });
    }
}
