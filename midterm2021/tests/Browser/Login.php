<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Login extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Email')
                ->type("#email", 'chsung1@gmail.com')
                ->type('#password', '11111111')
                ->press('button[type="submit"]')
                ->waitFor('#menu')
                ->assertSee('수강목록');
        });
    }


    public function test_login_as()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visit('/classes/registered')
                ->assertSee('수강학점');
        });
    }

    public function test_registered_classes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/classes/registered')
                ->assertSee('수강학점');
        });
    }

    public function test_admin_modal()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'admin@yju.ac.kr')->first();
            if ($user == null) {
                $user = User::create([
                    'email' => 'admin@yju.ac.kr',
                    'name' => 'admin',
                    'password' => Hash::make('11111111'),
                ]);
            }

            $browser->loginAs($user)
                ->visit('/classes')
                ->assertSee('교과목 목록');
        });
    }

    public function test_admin_class_create()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'admin@yju.ac.kr')->first();
            if ($user == null) {
                $user = User::create([
                    'email' => 'admin@yju.ac.kr',
                    'name' => 'admin',
                    'password' => Hash::make('11111111'),
                ]);
            }

            $browser->loginAs($user)
                ->visit('/classes/create')
                ->assertSee('교과목 목록')
                ->type('#name', 'Laravel Dusk Test')
                ->type('#credit', 3)
                // ->type('#description', 'Typed by Laravel dusk test code') // ckeditor와 연계 안되네...
                ->press('button[role="submit"]')
                ->waitForText('Laravel Dusk$ Test') // inertia기반 data는 axios이용한 비동기 요청. 기다려야.
                ->assertSee('Laravel Dusk');
        });
    }
}
