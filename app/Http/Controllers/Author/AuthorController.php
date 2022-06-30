<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Show all authors list
     */
    public function index()
    {
        $authors = DB::table('authors')
            ->join('photos', 'authors.photo_id', '=', 'photos.id')
            ->select('authors.*', 'photos.photo')
            ->get();
        return view('author.index')->with('authors', $authors);
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

    /**
     * Show Author's Edit Form
     * @param $id
     */
    public function edit($id)
    {
        $authors = DB::table('authors')
            ->join('photos', 'authors.photo_id', '=', 'photos.id')
            ->select('authors.*', 'photos.photo')
            ->where('authors.id', '=', $id)
            ->get();
        foreach ($authors as $author) {
            return view('author.edit')->with('author', $author);
        }
    }

    /**
     * Update the Author's Data
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        DB::table('authors')
            ->where('id', $id)
            ->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]
            );

        //if there is photo update
        if ($request->photo) {
            $oldPhotos = DB::table('authors')
                ->join('photos', 'authors.photo_id', '=', 'photos.id')
                ->select('authors.*', 'photos.photo')
                ->where('authors.id', '=', $id)
                ->get();
            foreach ($oldPhotos as $oldPhoto) {
                $oldPhotoId = $oldPhoto->id;
            }
            $newPhotoName = $request->name . '-' . $request->photo->extension();
            $request->photo->move((public_path("photos/author_photos")), $newPhotoName);
            DB::table('photos')
                ->where('id', $oldPhotoId)
                ->update(
                    [
                        'photo' => $newPhotoName
                    ]
                );
        }
        return redirect()->route('author.index')->with('success', 'Author Updated Successfully');
    }

    /**
     * Delete the authors
     * @param $id
     */
    public function delete($id)
    {
        if (DB::table('authors')->where('id', '=', $id)->delete()) {
            return redirect()->route('author.index')->with('success', 'Author deleted Successfully');
        }
    }
}
