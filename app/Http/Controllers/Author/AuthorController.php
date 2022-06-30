<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Show all authors list
     */
    public function index()
    {
        return view('author.index');
    }

    /**
     * Show Create Authors Form
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store Author's information to database
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'required | mimes:png,jpeg,jpg,gif'
        ]);
        $photo = new Photo();
        $photoName = $request->name . '-' . $request->photo->extension();
        $request->photo->move((public_path('photos/author_photos')), $photoName);
        $photo->photo = $photoName;
        $photo->save();
        $author = new Author();
        $lastUploadPhoto = Photo::latest()->first();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->address = $request->address;
        $author->photo_id = $lastUploadPhoto->id;
        if ($author->save()) {
            return redirect()->route('author.index')->with('success', 'Create Author Successfully');
        }
    }
}
