<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Inertia\Testing\Assert;

class Register extends DuskTestCase
{
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
                    ->type('#name', 'chsung11')
                    ->type('#email', 'chsung11@gmail.com')
                    ->type('#password', '11111111')
                    ->type('#password_confirmation', '11111111')
                    ->press('button[type="submit"]')
                    // ->waitUntilMissing('#nprogress');
                    ->waitFor('#app')
                    // ->assertPathIs('/dashboard');
                    // ->assertSee('Laravel Jetstream');
                    ->assertSee('Dashboard');
                    // ->assertInertia(fn (Assert $page) => $page->component('Pages/Dashboard')->has('name', 'chsung6'));
        });
    }
}
