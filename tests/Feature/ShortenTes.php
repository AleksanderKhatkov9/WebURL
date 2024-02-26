<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortenTes extends TestCase
{
    use RefreshDatabase;

    public function test_shorten()
    {
        $response = $this->json('POST', '/shorten', ['url' => 'https://example.com']);
        $response->assertStatus(200);
        $this->assertCount(1, Link::all());
        $link = Link::first();
        $this->assertEquals('https://example.com', $link->original_url);
        $this->assertStringContainsString(config('app.url'), $link->short_url);
        $response->assertJson(['shortened_url' => $link->short_url]);
    }

}
