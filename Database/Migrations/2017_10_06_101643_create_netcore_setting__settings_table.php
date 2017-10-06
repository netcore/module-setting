<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetcoreSettingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netcore_setting__settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group')->nullable();
            $table->string('name')->nullable();
            $table->string('key')->unique()->index();
            $table->text('value')->nullable();
            $table->enum('type', [
                'text',
                'select',
                'checkbox',
                'file'
            ])->default('text');
            $table->text('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_setting__settings');
    }
}
