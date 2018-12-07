<?php

namespace Tests\Feature;

use Tests\TestCase;

class MatchModuleTest extends TestCase
{
    /** @test */
    public function it_should_load_the_index_page()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Tic Tac Toe!');
    }
    
    /** @test */
    public function it_should_retrieve_matches_list()
    {
        $this->get('/api/match')
            ->assertStatus(200);
    }
    
    /** @test */
    public function it_should_create_matches_correctly()
    {
        $this->withoutMiddleware([
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ]);
        
        $this->post('/api/match/', [])
            ->assertStatus(200);
    }
}
