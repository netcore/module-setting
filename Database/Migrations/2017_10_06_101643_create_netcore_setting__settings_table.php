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
            $table->enum('type', [
                'text',
                'textarea',
                'select',
                'checkbox',
                'file'
            ])->default('text');
            $table->text('meta')->nullable();
            $table->boolean('has_manager')->default(0);
            $table->boolean('is_translatable')->default(0);
            $table->timestamps();
        });

        Schema::create('netcore_setting__setting_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('setting_id');
            $table->foreign('setting_id')->references('id')->on('netcore_setting__settings')->onDelete('cascade');

            $table->string('locale')->index();
            $table->mediumText('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('netcore_setting__setting_translations');
        Schema::dropIfExists('netcore_setting__settings');
    }
}
