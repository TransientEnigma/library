<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use refreshDatabase;
    /** @test **/
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/author', [
            'name' => 'Old Name',
            'dob' => '05/14/1988'
        ]);

        // this will be a collection
        $author = Author::all();

        $this->assertCount(1, Author::all());

        // $author is a collection so we get the first one.
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);

        // we should be able to format it so that it's in a format we expect
        // this will prove it is being parsed correctly
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }
}
