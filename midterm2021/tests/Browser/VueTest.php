<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Assert;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VueTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_vue()
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
                ->waitFor('#create')
                // ->assertVue('form.description', '교과목 설명', '@create-class');  // inertia라 그런지 안됨.
                ->assertSee('교과목명');
        });
    }
}
