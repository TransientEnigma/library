<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        // the create method will return us the instance of the created book
        $book = Book::create($this->validateRequest());

        return redirect($book->path());
    }

    public function update(Book $book)
    {
        $book->update($this->validateRequest());

        return redirect($book->path());
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
