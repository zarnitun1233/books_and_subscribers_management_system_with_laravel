<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Show Book List
     */
    public function index()
    {
        $books = DB::table('books')
            ->join('photos', 'books.photo_id', '=', 'photos.id')
            ->select('books.*', 'photos.photo')
            ->where('books.deleted_at', '=', null)
            ->get();
        return view('book.index')->with('books', $books);
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
            'author' => 'required',
            'category' => 'required',
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
        $book->author = json_encode($request->author);
        $book->category = json_encode($request->category);
        $book->published_date = $request->published_date;
        $book->status = "0";
        $bookName = $request->title . '-' . $request->book->extension();
        $request->book->move((public_path('books')), $bookName);
        $book->book = $bookName;
        if ($book->save()) {
            return redirect()->route('book.index')->with('success', 'Book Create Successfully');
        }
    }

    /**
     * Show Edit Book Form
     * @param $id
     */
    public function edit($id)
    {
        $bookData = DB::table('books')
            ->join('photos', 'books.photo_id', '=', 'photos.id')
            ->select('books.*', 'photos.photo')
            ->where('books.id', '=', $id)
            ->get();
        $categories = Category::all();
        $authors = Author::all();
        foreach ($bookData as $book) {
            $books = DB::table('books')
                ->join('photos', 'books.photo_id', '=', 'photos.id')
                ->select('books.*', 'photos.photo')
                ->where('books.deleted_at', '=', null)
                ->get();
            return view('book.edit')->with('books', $books)->with('book', $book)->with('categories', $categories)->with('authors', $authors);
        }
    }

    /**
     * Update Book Data into database
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_date' => 'required',
        ]);

        if ($request->photo) {
            $request->validate([
                'photo' => 'required | mimes:png,jpeg,jpg,gif',
            ]);
            $oldPhotos = DB::table('books')
                ->join('photos', 'books.photo_id', '=', 'photos.id')
                ->select('books.*', 'photos.photo')
                ->where('books.id', '=', $id)
                ->get();
            foreach ($oldPhotos as $oldPhoto) {
                $oldPhotoId = $oldPhoto->id;
            }
            $newPhotoName = $request->title . '-' . $request->photo->extension();
            $request->photo->move((public_path("photos/books_cover_photo")), $newPhotoName);
            DB::table('photos')
                ->where('id', $oldPhotoId)
                ->update(
                    [
                        'photo' => $newPhotoName
                    ]
                );
        }

        if ($request->book) {
            $request->validate([
                'book' => 'required | mimes:pdf,doc,docx | max:10000',
            ]);
            $oldBooks = DB::table('books')
                ->select('books.*')
                ->where('books.id', '=', $id)
                ->get();
            foreach ($oldBooks as $oldBook) {
                $oldBookId = $oldBook->id;
            }
            $newBookName = $request->title . '-' . $request->book->extension();
            $request->book->move((public_path("books/")), $newBookName);
            DB::table('books')
                ->where('id', $oldBookId)
                ->update(
                    [
                        'book' => $newBookName
                    ]
                );
        }

        $book = Book::where('id', $id)->first();
        if ($request->author) {
            $request->validate([
                'author' => 'required',
            ]);
            $book->author = json_encode($request->author);
        }

        if ($request->category) {
            $request->validate([
                'category' => 'required',
            ]);
            $book->category = json_encode($request->category);
        }


        DB::table('books')
            ->where('id', $id)
            ->update(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'published_date' => $request->published_date,
                ]
            );

        $book->save();
        return redirect()->route('book.index')->with('success', 'Book Updated Successfully');
    }

    /**
     * Delete Book
     * @param $id
     */
    public function delete($id)
    {
        DB::table('books')
            ->where('id', $id)
            ->update(
                [
                    'deleted_at' => now()
                ]
            );
        return redirect()->route('book.index')->with('success', 'Book deleted Successfully');
    }

    /**
     * Download Book File
     * @param $id
     */
    public function download($id)
    {
        $book = Book::where('id', $id)->get();
        $path = $book[0]->book;
        $download_link = public_path("books/$path");
        return response()->download($download_link);
    }
}
