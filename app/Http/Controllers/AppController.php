<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function list_contents()
    {
        $movies = Movie::all();
        return view('contents', compact('movies'));
    }

    public function ajax_new(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->description = $request->description;

        // image request poster
        $image = $request->file('poster');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('poster'), $image_name);
        $movie->poster = $image_name;
        $movie->save();

        echo 'saved';
    }

    public function modal_edit(Request $request)
    {
        $movie = Movie::find($request->id);
        return view('edit', compact('movie'));
    }

    public function ajax_edit(Request $request)
    {
        $movie = Movie::find($request->id_data);
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->description = $request->description;

        // image request poster
        if ($request->hasFile('poster')) {
            $image = $request->file('poster');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('poster'), $image_name);
            $movie->poster = $image_name;
        }

        $movie->update();

        echo 'updated';
    }

    public function ajax_delete(Request $request)
    {
        $movie = Movie::find($request->id_data);
        $movie->delete();

        echo 'deleted';
    }
}
