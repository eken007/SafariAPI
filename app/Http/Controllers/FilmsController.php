<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use App\Models\Genre;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $film = Video::where('rubrique', 'film')->orderBy('created_at','DESC')->take(20)->get();
        return response()->json($film);
        //$response = ['message' => 'article index'];
        //return response($response, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $film = new Video();

        $film->creator_id = Auth::user()->id;

        $film->titre = $request->titre;
        $film->rubrique = 'film';
        $film->date_de_sortie = $request->date_de_sortie;
        $film->duree = $request->duree;
        $film->qualite = $request->qualite;
        $film->description = $request->description;
        $film->age = $request->age;
        $film->banniere = false;

        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('films'),$newfilename);
            $film->video = $newfilename;
        }

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('images'),$newfilename);
            $film->image = $newfilename;
        }

        if ($request->hasfile('pub')) {
            $file = $request->file('pub');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('publicites'),$newfilename);
            $film->pub = $newfilename;
        }

        $film->save();

        return response()->json($film);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveacteur(Request $request, $id)
    {

        $acteur = new Acteur();

        $acteur->nom = $request->nom;

        $acteur->film_id = $id;

        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('acteurs'),$newfilename);
            $acteur->photo = $newfilename;
        }

        $acteur->save();

        return response()->json($acteur);
    }

    public function savegenre(Request $request, $id)
    {

        $genre = new Genre();

        $genre->nom = $request->nom;

        $genre->film_id = $id;

        $genre->save();

        return response()->json($genre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
