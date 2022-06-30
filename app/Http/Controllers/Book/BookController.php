<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Photo;

class BookController extends Controller
{
    /**
     * Show Book List
     */
    public function index()
    {
        return view('book.index');
    }

    /**
     * Show Create Book Form
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('book.create')->with('authors', $authors)->with('categories', $categories);
    }

    /**
     * Storing Book Data to Database
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required | mimes:png,jpeg,jpg,gif',
            'description' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'published_date' => 'required',
            'book' => 'required | mimes:pdf,doc,docx | max:10000',
        ]);
        $photo = new Photo();
        $photoName = $request->title . '-' . $request->photo->extension();
        $request->photo->move((public_path('photos/books_cover_photo')), $photoName);
        $photo->photo = $photoName;
        $photo->save();
        $book = new Book();
        $lastUploadPhoto = Photo::latest()->first();
        $book->title = $request->title;
        $book->photo_id = $lastUploadPhoto->id;
        $book->description = $request->description;
        $book->author_id = implode(",",$request->author_id);
        $book->category_id = implode(",",$request->category_id);
        $book->published_date = $request->published_date;
        $book->status = "0";
        $bookName = $request->title . '-' . $request->book->extension();
        $request->book->move((public_path('books')), $bookName);
        $book->book = $bookName;
        if ($book->save()) {
            return redirect()->route('book.index')->with('success', 'Book Create Successfully');
        }
    }
}
