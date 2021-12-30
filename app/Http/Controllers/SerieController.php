<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Saison;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Video::where('rubrique', 'serie')->orderBy('created_at','DESC')->take(20)->get();
        return response()->json($series);
    }

    public function allSeries(){
        $series = Video::where('rubrique', 'serie')->orderBy('created_at','DESC')->get();
        return response()->json($series);
    }

    public function search()
    {                                
        if(request('titre') == null){
            return $this->refresh();
        } else{
            $series = Video::where('titre','like', '%'.request('titre').'%')->where('rubrique', 'serie')->orderBy('created_at','DESC')->get();
            return response()->json($series);
        }
    }

    private function refresh(){
        $series = Video::orderBy('created_at','DESC')->where('rubrique', 'serie')->get();
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
        $serie->banniere = false;


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

        $series = Video::select('*')->where('rubrique','serie')->get();

        return response()->json($series);
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
        $serie = Acteur::find($id);
        $acteur = Acteur::find($id);
        $acteur->delete();

        $acteurs = Acteur::where('film_id', $serie->film_id)->get();
        return response()->json($acteurs);
    }

    public function savegenre(Request $request)
    {

        $genre = new Genre();

        $genre->nom = $request->nom;

        $genre->film_id = $request->id;


        $genre->save();

        $genres = Genre::where('film_id', $request->id)->get();

        return response()->json($genres);
    }

    public function deletegenre($id)
    {
        $serie = Genre::find($id);
        $genre = Genre::find($id);
        $genre->delete();

        $genres = Genre::where('film_id', $serie->film_id)->get();
        return response()->json($genres);
    }

    public function savesaison(Request $request)
    {
        if(DB::table('saisons')->where('nom', $request->nom)->where('film_id', $request->id)->exists()){
            $response = ["message" => "Saison exist"];
            return response($response, 422);
        } else {
            $saison = new Saison();

            $saison->nom = $request->nom;

            $saison->film_id = $request->id;

            $saison->save();

            $saisons = Saison::where('film_id', $request->id)->orderBy('nom','ASC')->get();

            return response()->json($saisons);
        }
        
    }

    public function deletesaison($id)
    {
        $serie = Saison::find($id);
        $saison = Saison::find($id);
        $saison->delete();

        $episodes = Episode::where('saison_id', $id)->get();
        foreach($episodes as $episode){
            $episode->delete();
        }

        $saisons = Saison::where('film_id', $serie->film_id)->orderBy('nom','ASC')->get();
        return response()->json($saisons);
    }

    public function saveepisode(Request $request)
    {
        if(DB::table('episodes')->where('nom', $request->nom)->where('saison_id', $request->saison_id)->exists()){
            $response = ["message" => "Episode exist"];
            return response($response, 422);
        } else {

            $episode = new Episode();

            $episode->nom = $request->nom;

            $episode->saison_id = $request->saison_id;

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

            $episodes = Episode::where('saison_id', $request->saison_id)->orderBy('nom','ASC')->get();

            return response()->json($episodes);

        }
    }

    public function deleteepisode($id)
    {
        $saison = Episode::find($id);
        $episode = Episode::find($id);
        $episode->delete();

        $episodes = Episode::where('saison_id', $saison->saison_id)->orderBy('nom','ASC')->get();
        return response()->json($episodes);
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
    public function deleteserie($id)
    {
        $serie = Video::find($id);
        $serie->delete();

        $genres = Genre::where('film_id', $id)->get();
        foreach($genres as $genre){
            $genre->delete();
        }

        $acteurs = Acteur::where('film_id', $id)->get();
        foreach($acteurs as $acteur){
            $acteur->delete();
        }

        $saisons = Acteur::where('film_id', $id)->get();
        foreach($saisons as $saison){
            $saison->delete();
        }

        $series = Video::select('*')->where('rubrique','serie')->orderBy('created_at','DESC')->get();
        return response()->json($series);
    }




    /**methodes serie novelas*/





    public function savenovelas(Request $request)
    {
        $serie = new Video();

        $serie->creator_id = Auth::user()->id;

        $serie->titre = $request->titre;
        $serie->rubrique = 'novelas';
        $serie->date_de_sortie = $request->date_de_sortie;
        $serie->description = $request->description;
        $serie->age = $request->age;
        $serie->banniere = false;


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

        $series = Video::select('*')->where('rubrique','novelas')->get();

        return response()->json($series);
    }

    public function allnovelas(){
        $series = Video::where('rubrique', 'novelas')->orderBy('created_at','DESC')->get();
        return response()->json($series);
    }

    public function searchnovelas()
    {                                
        if(request('titre') == null){
            return $this->refreshnovelas();
        } else{
            $series = Video::where('titre','like', '%'.request('titre').'%')->where('rubrique', 'novelas')->orderBy('created_at','DESC')->get();
            return response()->json($series);
        }
    }

    private function refreshnovelas(){
        $series = Video::orderBy('created_at','DESC')->where('rubrique', 'novelas')->get();
        return response()->json($series);
    }

    public function deletenovelas($id)
    {
        $novelas = Video::find($id);
        $novelas->delete();

        $genres = Genre::where('film_id', $id)->get();
        foreach($genres as $genre){
            $genre->delete();
        }

        $acteurs = Acteur::where('film_id', $id)->get();
        foreach($acteurs as $acteur){
            $acteur->delete();
        }

        $saisons = Acteur::where('film_id', $id)->get();
        foreach($saisons as $saison){
            $saison->delete();
        }

        $series = Video::select('*')->where('rubrique','novelas')->orderBy('created_at','DESC')->get();
        return response()->json($series);
    }





     /**methodes serie novelas*/





     public function savewebserie(Request $request)
     {
         $serie = new Video();
 
         $serie->creator_id = Auth::user()->id;
 
         $serie->titre = $request->titre;
         $serie->rubrique = 'web serie';
         $serie->date_de_sortie = $request->date_de_sortie;
         $serie->description = $request->description;
         $serie->age = $request->age;
         $serie->banniere = false;
 
 
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
 
         $series = Video::select('*')->where('rubrique','web serie')->get();
 
         return response()->json($series);
     }
 
     public function allwebserie(){
         $series = Video::where('rubrique', 'web serie')->orderBy('created_at','DESC')->get();
         return response()->json($series);
     }
 
     public function searchwebserie()
     {                                
         if(request('titre') == null){
             return $this->refreshwebserie();
         } else{
             $series = Video::where('titre','like', '%'.request('titre').'%')->where('rubrique', 'web serie')->orderBy('created_at','DESC')->get();
             return response()->json($series);
         }
     }
 
     private function refreshwebserie(){
         $series = Video::orderBy('created_at','DESC')->where('rubrique', 'web serie')->get();
         return response()->json($series);
     }

     public function deletewebserie($id)
    {
        $novelas = Video::find($id);
        $novelas->delete();

        $genres = Genre::where('film_id', $id)->get();
        foreach($genres as $genre){
            $genre->delete();
        }

        $acteurs = Acteur::where('film_id', $id)->get();
        foreach($acteurs as $acteur){
            $acteur->delete();
        }

        $saisons = Acteur::where('film_id', $id)->get();
        foreach($saisons as $saison){
            $saison->delete();
        }

        $series = Video::select('*')->where('rubrique','web serie')->orderBy('created_at','DESC')->get();
        return response()->json($series);
    }


}
