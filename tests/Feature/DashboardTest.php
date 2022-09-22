<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public object $user;

    /**
     *
     * @return void
     */
    #[NoReturn]
    protected function setUp(): void
    {
        parent::setUp();

        $this->post(route('login'), [
            'username' => 'apiuser',
            'password' => 'password',
        ]);

        $this->user = auth()->user();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_on_the_dashboard(): void
    {

        $response = $this->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertStatus(HttpResponse::HTTP_OK)
            ->assertSee(__('Dashboard'))
            ->assertSee(__('Basic Stats'))
            ->assertSee(__('Users'))
            ->assertSee(__('Channels'))
            ->assertSee(__('Bans'))

            ->assertSee('OperServ')
            ->assertSee('HostServ')
            ->assertSee('NickServ')
            ->assertSee('ChanServ')
            ->assertSee('MemoServ')
            ->assertSee('BotServ')
            ->assertSee('Global')

            ->assertSee('Username')
            ->assertSee('Server')
            ->assertSee('Channels')
            ->assertSee('Modes')
            ->assertSee('VHost')
            ->assertSee('ioqBS');
    }

    public function test_channels_on_the_dashboard()
    {
        $response = $this->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertStatus(HttpResponse::HTTP_OK)
            ->assertSee(__('Dashboard'))
            ->assertSee(__('Basic Stats'))
            ->assertSee(__('Users'))
            ->assertSee(__('Channels'))
            ->assertSee(__('Bans'))

            ->assertSee('#chat')
            ->assertSee('#ops')
            ->assertSee('#services')
            ->assertSee('nrtP')
            ->assertSee('Name')
            ->assertSee('num_users')
            ->assertSee('Modes');
    }

    public function test_bans_on_the_dashboard()
    {
        $response = $this->actingAs($this->user)
            ->get(route('dashboard'));

        $response->assertStatus(HttpResponse::HTTP_OK)
            ->assertSee(__('Dashboard'))
            ->assertSee(__('Basic Stats'))
            ->assertSee(__('Users'))
            ->assertSee(__('Channels'))
            ->assertSee(__('Bans'))

            ->assertSee('type')
            ->assertSee('name')
            ->assertSee('expire_at')
            ->assertSee('reason')
            ->assertSee('set_at_string')
            ->assertSee('set_by')
            ->assertSee('zline')
            ->assertSee('Hate you')
            ->assertSee('*@195.86.232.81')
            ->assertSee('Never')
            ->assertSee('-config-');
    }
}
