<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $first, Browser $second) {
            $first->loginAs($user = User::query()->find(1))
                ->visitRoute('chat')
                ->waitFor('.chat-composer');

            $second->loginAs(User::query()->find(2))
                ->visitRoute('chat')
                ->waitFor('.chat-composer')
                ->type('message', 'Hey Taylor')
                ->press('Send');

            $first->waitForText('Hey Taylor')
                ->assertSee($user->name);
        });
    }
}
