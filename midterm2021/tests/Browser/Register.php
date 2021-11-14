<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Inertia\Testing\Assert;

class Register extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_register_form()
    {
        // $this->browse(function (Browser $browser) {
        //     $browser->visit('/register')
        //             ->type('name', 'chsung')
        //             ->type('email', 'chsung@gmail.com')
        //             ->type('password', '11111111')
        //             ->type('password_confirmation', '11111111')
        //             ->press('Register')
        //             ->assertPathIs('/dashboard');
        // });

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('#name', 'chsung1')
                    ->type('#email', 'chsung1@gmail.com')
                    ->type('#password', '11111111')
                    ->type('#password_confirmation', '11111111')
                    ->press('button[type="submit"]')
                    // ->waitUntilMissing('#nprogress')
                    ->waitFor('#menu')
                    // ->assertPathIs('/dashboard');
                    // ->assertSee('Welcome');
                    // ->waitForText('Dashboard')
                    ->assertSee('수강목록');
                    // ->assertInertia(fn (Assert $page) => $page->component('Pages/Dashboard')->has('name', 'chsung6'));
        });
    }
}
