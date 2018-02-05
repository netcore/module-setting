<?php

namespace Modules\Setting\Tests;

use Modules\Setting\Models\Setting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingTest extends TestCase
{
    /** @test */
    public function guests_cannot_edit_settings()
    {
        $setting = Setting::first();

        $this->get(route('admin::setting.edit', $setting))->assertRedirect('admin/login');
    }

    /** @test */
    public function admins_can_edit_settings()
    {
        $setting = Setting::first();
        $user = app(config('netcore.module-admin.user.model'))->where('is_admin', 1)->first();
        $this->be($user);

        $this->get(route('admin::setting.edit', $setting))->assertStatus(200);
    }
}
