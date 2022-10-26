<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Museum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $highest_voted_artwork = Artwork::orderBy('votes','desc')
                                    ->first();
        
        $artist_of_the_month = $highest_voted_artwork->artist;
        $highest_voted_artwork_asset = $highest_voted_artwork->asset->asset_url;

        $all_artworks_by_votes = Artwork::orderBy('votes','desc')->get();
        
        $all_artworks_by_recommendations = Artwork::all()->shuffle();

        $museums = Museum::all();

        $museum_collections = [];
        foreach ($museums as $museum) {
            $museum_details = new stdClass();
            
            $museum_details->name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $museum_artists = $museum->museum_artist;

            $artist_collections = [];
            foreach ($museum_artists as $museum_artist) {
                $artist = $museum_artist->artist;

                $artist_details = new stdClass();

                $artist_details->name = $artist->name;
                $artist_details->start_date = Carbon::parse($museum_artist->datetime_start);
                $artist_details->start_end = Carbon::parse($museum_artist->datetime_end);

                $artworks = $artist->artwork;

                $asset_urls = [];
                foreach ($artworks as $artwork) {
                    $asset = $artwork->asset;

                    $asset_urls[] = $asset->asset_url;
                }
                $artist_details->images_list = $asset_urls;

                $artist_collections[] = $artist_details;
            }

            $museum_details->artists_list = $artist_collections;

            $museum_collections[] = $museum_details;
        }

        return view(
            'wad2.homepage',
            [
                'highest_voted_artwork'               => $highest_voted_artwork,
                'artist_of_the_month'                 => $artist_of_the_month,
                'highest_voted_artwork_asset'         => $highest_voted_artwork_asset,
                'all_artworks_by_votes'               => $all_artworks_by_votes,
                'all_artworks_by_recommendations'     => $all_artworks_by_recommendations,
                'museum_collections'                  => $museum_collections,
            ]
        );
    }

    public function indexExplore()
    {
        $highest_voted_artwork = Artwork::orderBy('votes','desc')
                                    ->first();
        
        $artist_of_the_month = $highest_voted_artwork->artist;
        $highest_voted_artwork_asset = $highest_voted_artwork->asset->asset_url;

        $all_artworks_by_votes = Artwork::orderBy('votes','desc')->get();
        
        $all_artworks = Artwork::all()->shuffle();

        $museums = Museum::all();

        $museum_collections = [];
        foreach ($museums as $museum) {
            $museum_details = new stdClass();
            
            $museum_details->name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $museum_artists = $museum->museum_artist;

            $artist_collections = [];
            foreach ($museum_artists as $museum_artist) {
                $artist = $museum_artist->artist;

                $artist_details = new stdClass();

                $artist_details->name = $artist->name;
                $artist_details->start_date = Carbon::parse($museum_artist->datetime_start);
                $artist_details->start_end = Carbon::parse($museum_artist->datetime_end);

                $artworks = $artist->artwork;

                $asset_urls = [];
                foreach ($artworks as $artwork) {
                    $asset = $artwork->asset;

                    $asset_urls[] = $asset->asset_url;
                }
                $artist_details->images_list = $asset_urls;

                $artist_collections[] = $artist_details;
            }

            $museum_details->artists_list = $artist_collections;

            $museum_collections[] = $museum_details;
        }

        return view(
            'wad2.explore',
            [
                'highest_voted_artwork'               => $highest_voted_artwork,
                'artist_of_the_month'                 => $artist_of_the_month,
                'highest_voted_artwork_asset'         => $highest_voted_artwork_asset,
                'all_artworks_by_votes'               => $all_artworks_by_votes,
                'artworks'                            => $all_artworks,
                'museum_collections'                  => $museum_collections,
            ]
        );
    }
}
