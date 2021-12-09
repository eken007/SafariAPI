<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Saison;
use App\Models\Video;
use Illuminate\Http\Request;

class AllRubriquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if(request('mot') == null){
            return $this->refresh();
        } else{
            $videos = Video::where('titre','like', '%'.request('mot').'%')->orderBy('created_at','DESC')->get();
            return response()->json($videos);
        }
    }

    private function refresh(){
        $videos = Video::orderBy('created_at','DESC')->get();
        return response()->json($videos);
    }

    public function activepublicite(Video $video){
        $video->banniere = true;

        $video->update();

        return response()->json($video);
    }

    public function publicite(){
        
        $publicite = Video::where('banniere', true )->orderBy('created_at','DESC')->take(5)->get();
        return response()->json($publicite);
    }

    public function detailpage($id){
        
        $video = Video::where('id', $id )->get();
        $acteurs = Acteur::where('film_id', $id )->get();
        $genres = Genre::where('film_id', $id )->get();
        $saisons = Saison::where('film_id', $id )->get();
        return response()->json([$video, $acteurs,$genres, $saisons]);
    }

    public function episodes($id){
        
        $episodes = Episode::where('saison_id', $id )->get();
        return response()->json($episodes);
    }

}
