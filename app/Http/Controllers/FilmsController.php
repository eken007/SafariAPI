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
            $films = Video::where('rubrique', 'film')->orderBy('created_at','DESC')->take(20)->get();
            return response()->json($films);
        
        //$response = ['message' => 'article index'];
        //return response($response, 200);

    }

    public function allFilms(){
        $films = Video::where('rubrique', 'film')->orderBy('created_at','DESC')->get();
        return response()->json($films);
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

        $films = Video::select('*')->where('rubrique','film')->get();

        return response()->json($films);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveacteur(Request $request)
    {

        $acteur = new Acteur();

        $acteur->nom = $request->nom;

        $acteur->film_id = $request->id;

        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('acteurs'),$newfilename);
            $acteur->photo = $newfilename;
        }

        $acteur->save();

        $acteurs = Acteur::select('*')->where('film_id', $request->id)->get();

        return response()->json($acteurs);
    }

    public function deleteacteur($id)
    {
        $film = Acteur::find($id);
        $acteur = Acteur::find($id);
        $acteur->delete();

        $acteurs = Acteur::where('film_id', $film->film_id)->get();
        return response()->json($acteurs);
    }

    public function savegenre(Request $request)
    {

        $genre = new Genre();

        $genre->nom = $request->nom;

        $genre->film_id = $request->id;

        $genre->save();

        $genres = Genre::select('*')->where('film_id', $request->id)->get();

        return response()->json($genres);
    }

    public function deletegenre($id)
    {
        $film = Genre::find($id);
        $genre = Genre::find($id);
        $genre->delete();

        $genres = Genre::where('film_id', $film->film_id)->get();
        return response()->json($genres);
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
    public function deletefilm($id)
    {
        $film = Video::find($id);
        $film->delete();

        $genres = Genre::where('film_id', $id)->get();
        foreach($genres as $genre){
            $genre->delete();
        }

        $acteurs = Acteur::where('film_id', $id)->get();
        foreach($acteurs as $acteur){
            $acteur->delete();
        }

        $films = Video::select('*')->where('rubrique','film')->get();
        return response()->json($films);
    }

    public function search()
    {                                
        if(request('titre') == null){
            return $this->refresh();
        } else{
            $films = Video::where('titre','like', '%'.request('titre').'%')->where('rubrique', 'film')->orderBy('created_at','DESC')->get();
            return response()->json($films);
        }
    }

    private function refresh(){
        $videos = Video::orderBy('created_at','DESC')->where('rubrique', 'film')->get();
        return response()->json($videos);
    }

}
