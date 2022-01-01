<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use App\Models\User;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Saison;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllRubriquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {                                
        return $this->refresh();
    }

    private function refresh(){
        $videos = Video::orderBy('created_at','DESC')->get();
        return response()->json($videos);
    }

    public function activepublicite(Video $video){
        
        if( $video->banniere == false) {

            $video->banniere = true;
            $video->update();
        } else {
            $video->banniere = false;
            $video->update();
        }

        
        return response()->json($video);
    }

    public function publicite(){
        
        $publicite = Video::where('banniere', true )->orderBy('created_at','DESC')->take(5)->get();
        return response()->json($publicite);
    }

    public function detailpage($id){

            //la video
        $video = Video::where('id', $id )->get();

            //les cateurs de la video
        $acteurs = Acteur::where('film_id', $id )->take(10)->get();

            //les genres de la video
        $genres = Genre::where('film_id', $id )->take(3)->get();

            //ses saisons video
        $saisons = Saison::where('film_id', $id )->orderBy('nom','ASC')->get();

            // les films ou series similaires 
        $genre = Genre::where('film_id', $id )->first();
        if($genre){
            $similaire = Video::select('videos.*','videos.id','videos.titre')->where('videos.id','!=', $id)->take(20)
            ->join('genres as a', 'videos.id', '=', 'a.film_id')->where('a.nom', '=', $genre->nom)
            ->get();
        } else {
            $similaire = [];
        }
        

        return response()->json([$video, $acteurs,$genres, $saisons, $similaire]);
    }

    public function episodes($id){
        
        $episodes = Episode::where('saison_id', $id )->get();
        return response()->json($episodes);
    }

    public function statistique(){

        //films
        $films = Video::select('*')->where('rubrique', 'film')->get();

        //series
        $series = Video::select('*')->where('rubrique', 'serie')->get();
    
        //webseries
        $webseries = Video::select('*')->where('rubrique', 'web serie')->get();
    
        //novelas
        $novelas = Video::select('*')->where('rubrique', 'novelas')->get();

        //users

        $users = User::all();
        

        return response()->json([$films, $series, $users, $webseries,$novelas]);
    }


    public function allepisodes($id){

            //episodes
        $episodes = Episode::where('saison_id', $id )->orderBy('nom','ASC')->get();

            // les films ou series similaires 
        if($episodes){
            $saison = Saison::where('id', $id )->get();
        } 
    

    return response()->json([$episodes, $saison]);
}

}
