<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Saison;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(request('mot') == null){
            return $this->refresh();
        } else{
            $series = Video::where('rubrique', 'serie')->where('titre','like', '%'.request('mot').'%')->orderBy('created_at','DESC')->get();
            return response()->json($series);
        }
    }

    private function refresh(){
        $series = Video::where('rubrique', 'serie')->orderBy('created_at','DESC')->take(20)->get();
        return response()->json($series);
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
        $serie = new Video();

        $serie->creator_id = Auth::user()->id;

        $serie->titre = $request->titre;
        $serie->rubrique = 'serie';
        $serie->date_de_sortie = $request->date_de_sortie;
        $serie->description = $request->description;
        $serie->age = $request->age;
        $serie->baniere = false;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('images'),$newfilename);
            $serie->image = $newfilename;
        }

        if ($request->hasfile('pub')) {
            $file = $request->file('pub');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('publicites'),$newfilename);
            $serie->pub = $newfilename;
        }

        $serie->save();

        return response()->json($serie);
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

    public function savesaison(Request $request, $id)
    {

        $saison = new Saison();

        $saison->nom = $request->nom;

        $saison->film_id = $id;

        $saison->save();

        return response()->json($saison);
    }

    public function saveepisode(Request $request, $id)
    {

        $episode = new Episode();

        $episode->nom = $request->nom;

        $episode->saison_id = $id;

        $episode->titre = $request->titre;

        $episode->qualite = $request->qualite;

        $episode->duree = $request->duree;

        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $newfilename = time().'.'.$extension;
            $file->move(public_path('episodes'),$newfilename);
            $episode->video = $newfilename;
        }

        $episode->save();

        return response()->json($episode);
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
