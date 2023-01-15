<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
       $response = $this->post('/books', [
           'title' => 'Cool Book Title',
           'author' => 'Victor',
       ]);

       $book = Book::first();

       $this->assertCount(1, Book::all());

       $response->assertRedirect($book->path());
    }
    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Victor',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Old Title',
            'author' => 'Old Author',
        ]);

        $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);

        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
           'title' => 'Old Title',
           'author' => 'Old Author',
        ]);

        // confirm the book record exists
        $this->assertCount(1, Book::all());

        $book = Book::first();

        $response = $this->delete($book->path());

        // confirm the record has been deleted
        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }
}
