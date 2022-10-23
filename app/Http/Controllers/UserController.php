<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Asset;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $artworks = $user->artwork;

        $museum_artists_involvement = $user->museum_artist;

        $artwork_rankings = Artwork::orderBy('votes', 'DESC')->get();

        $user_ranking = 1;
        foreach ($artwork_rankings as $artwork_ranking) {
            if ($artwork_ranking->artist_id == $user_id) {
                break;
            }
            else {
                $user_ranking++;
            }
        }

        $events_details = [];

        foreach ($museum_artists_involvement as $involvement) {
            $museum = $involvement->museum;

            $museum_details = new stdClass();
            $museum_details->museum_name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $artwork_urls = [];
            foreach ($artwork_rankings as $artwork) {
                $artwork_urls[] = $artwork->asset->asset_url;
            }

            $museum_details->images_list = $artwork_urls;

            $events_details[] = $museum_details;
        }

        return view('wad2.user.account',
            [
                'user'                           => $user, 
                'artworks'                       => $artworks, 
                'museum_artists_involvement'     => $museum_artists_involvement, 
                'user_ranking'                   => $user_ranking, 
                'events_details'                 => $events_details, 
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('wad2.user.edit',
            [
                'user'         => $user, 
            ]);
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
        $custom_error = [
            'email.required'        => "The user's email is required.",
            'email.unique'          => "The email :input has already been taken.",
        ];

        $validator = $request->validate([
            'name'               => ['required'],
            'email'              => ['required', 'email', 'unique:users,email,'.$id],
            'profile_picture'    => ['nullable', 'mimes:jpg,jpeg,png'],
            'banner'             => ['nullable', 'mimes:jpg,jpeg,png'],
        ], $custom_error);

        $profile_picture = $request->file('profile_picture');
        $banner = $request->file('banner');

        if ((is_uploaded_file($profile_picture)) && (is_uploaded_file($banner))) {
            try {
                $blob_controller = new BlobController();
                $user_profile_picture = $blob_controller->uploadImage($request, 'profile_picture');
                $profile_picture_url = json_decode($user_profile_picture->getContent())->url;
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong while uploading your profile picture!')->withInput();
            }

            try {
                $blob_controller = new BlobController();
                $user_banner_picture = $blob_controller->uploadImage($request, 'banner');
                $banner_picture_url = json_decode($user_banner_picture->getContent())->url;
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong while uploading your banner!')->withInput();
            }

            // creates asset for session picture
            $profile_picture_upload = Asset::create([
                'asset_url'             => $profile_picture_url
            ]);

            $asset_id_profile_picture = $profile_picture_upload->id;

            // creates asset for banner picture
            $banner_picture_upload = Asset::create([
                'asset_url'             => $banner_picture_url
            ]);

            $asset_id_banner_picture = $banner_picture_upload->id;
            
            $user_add = User::where('id', $id)->update(
                [
                    'name'              => trim($request->input('name')),
                    'email'             => trim($request->input('email')),
                    'asset_id'          => $asset_id_profile_picture,
                    'banner_id'         => $asset_id_banner_picture,
                ]
            );
        }
        elseif (is_uploaded_file($profile_picture)) {
            try {
                $blob_controller = new BlobController();
                $user_profile_picture = $blob_controller->uploadImage($request, 'profile_picture');
                $profile_picture_url = json_decode($user_profile_picture->getContent())->url;
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong while uploading your profile picture!')->withInput();
            }

            // creates asset for session picture
            $profile_picture_upload = Asset::create([
                'asset_url'             => $profile_picture_url
            ]);

            $asset_id_profile_picture = $profile_picture_upload->id;
            
            $user_add = User::where('id', $id)->update(
                [
                    'name'              => trim($request->input('name')),
                    'email'             => trim($request->input('email')),
                    'asset_id'          => $asset_id_profile_picture,
                ]
            );
        }
        elseif (is_uploaded_file($banner)) {
            try {
                $blob_controller = new BlobController();
                $user_banner_picture = $blob_controller->uploadImage($request, 'banner');
                $banner_picture_url = json_decode($user_banner_picture->getContent())->url;
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong while uploading your banner!')->withInput();
            }

            // creates asset for banner picture
            $banner_picture_upload = Asset::create([
                'asset_url'             => $banner_picture_url
            ]);

            $asset_id_banner_picture = $banner_picture_upload->id;
            
            $user_add = User::where('id', $id)->update(
                [
                    'name'              => trim($request->input('name')),
                    'email'             => trim($request->input('email')),
                    'banner_id'         => $asset_id_banner_picture,
                ]
            );
        }
        else {
            $user_add = User::where('id', $id)->update(
                [
                    'name'              => trim($request->input('name')),
                    'email'             => trim($request->input('email')),
                ]
            );
        }

        $user = User::where('id', $id)->first();

        $artworks = $user->artwork;

        $museum_artists_involvement = $user->museum_artist;

        $artwork_rankings = Artwork::orderBy('votes', 'DESC')->get();

        $user_ranking = 1;
        foreach ($artwork_rankings as $artwork_ranking) {
            if ($artwork_ranking->artist_id == $id) {
                break;
            }
            else {
                $user_ranking++;
            }
        }

        $events_details = [];

        foreach ($museum_artists_involvement as $involvement) {
            $museum = $involvement->museum;

            $museum_details = new stdClass();
            $museum_details->museum_name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $artwork_urls = [];
            foreach ($artwork_rankings as $artwork) {
                $artwork_urls[] = $artwork->asset->asset_url;
            }

            $museum_details->images_list = $artwork_urls;

            $events_details[] = $museum_details;
        }
        
        return view('wad2.user.account',
            [
                'user'                              => $user, 
                'artworks'                          => $artworks, 
                'museum_artists_involvement'        => $museum_artists_involvement, 
                'user_ranking'                      => $user_ranking, 
                'events_details'                    => $events_details, 
            ]);
    }

    /**
     * Show the form for adding artworks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addArtwork($user_id)
    {
        return view('wad2.artwork.add',
            [
                'user_id'                   => $user_id
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArtworkAdd(Request $request, $user_id)
    {
        $custom_error = [
            'title.required'                => "The title of the artwork to be uploaded is required.",
            'description.required'          => "The description of the artwork to be uploaded is required.",
            'artwork.required'              => "An artwork to be uploaded is required.",
            'artwork.dimensions'            => "The artwork must measure 1080px x 1080px in dimensions.",
        ];

        $validator = $request->validate([
            'title'                 => ['required'],
            'description'           => ['required'],
            'artwork'               => ['required', 'mimes:jpg,jpeg,png', 'dimensions:min_width=1080,min_height=1080,max_width=1080,max_height=1080'],
        ], $custom_error);

        $artwork = $request->file('profile_picture');

        try {
            $blob_controller = new BlobController();
            $user_artwork = $blob_controller->uploadImage($request, 'artwork');
            $artwork_url = json_decode($user_artwork->getContent())->url;
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while uploading your artwork!')->withInput();
        }

        // creates asset for banner picture
        $artwork_picture_upload = Asset::create([
            'asset_url'             => $artwork_url
        ]);

        $asset_id_artwork = $artwork_picture_upload->id;
        
        $user_artwork_add = Artwork::create(
            [
                'title'                 => trim($request->input('title')),
                'artist_id'             => $user_id,
                'asset_id'              => $asset_id_artwork,
                'description'           => trim($request->input('description')),
            ]
        );

        $user = User::where('id', $user_id)->first();

        foreach (User::all() as $user_to_notify) {
            if ($user_to_notify->id != $user_id) {
                $new_artwork_notification = Notification::create(
                    [
                        'description'           => "$user->name has just uploaded a new stunning piece titled \"$user_artwork_add->title\"!",
                        'artwork_id'            => $user_artwork_add->id,
                        'user_id'               => $user_to_notify->id,
                    ]
                );
            }
        }

        $artworks = $user->artwork;

        $museum_artists_involvement = $user->museum_artist;

        $artwork_rankings = Artwork::orderBy('votes', 'DESC')->get();

        $user_ranking = 1;
        foreach ($artwork_rankings as $artwork_ranking) {
            if ($artwork_ranking->artist_id == $user_id) {
                break;
            }
            else {
                $user_ranking++;
            }
        }

        $events_details = [];

        foreach ($museum_artists_involvement as $involvement) {
            $museum = $involvement->museum;

            $museum_details = new stdClass();
            $museum_details->museum_name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $artwork_urls = [];
            foreach ($artwork_rankings as $artwork) {
                $artwork_urls[] = $artwork->asset->asset_url;
            }

            $museum_details->images_list = $artwork_urls;

            $events_details[] = $museum_details;
        }
        
        return view('wad2.user.account',
            [
                'user'                              => $user, 
                'artworks'                          => $artworks, 
                'museum_artists_involvement'        => $museum_artists_involvement, 
                'user_ranking'                      => $user_ranking, 
                'events_details'                    => $events_details, 
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyArtwork($user_id, $artwork_id)
    {
        $artwork_delete = Artwork::where('id', $artwork_id)->delete();

        if (!$artwork_delete) {
            return redirect()->back()->withErrors(['artwork_error' => 'Something went wrong while trying to delete this artwork. Please try again.']);
        }

        $user = User::where('id', $user_id)->first();

        $artworks = $user->artwork;

        $museum_artists_involvement = $user->museum_artist;

        $artwork_rankings = Artwork::orderBy('votes', 'DESC')->get();

        $user_ranking = 1;
        foreach ($artwork_rankings as $artwork_ranking) {
            if ($artwork_ranking->artist_id == $user_id) {
                break;
            }
            else {
                $user_ranking++;
            }
        }

        $events_details = [];

        foreach ($museum_artists_involvement as $involvement) {
            $museum = $involvement->museum;

            $museum_details = new stdClass();
            $museum_details->museum_name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $artwork_urls = [];
            foreach ($artwork_rankings as $artwork) {
                $artwork_urls[] = $artwork->asset->asset_url;
            }

            $museum_details->images_list = $artwork_urls;

            $events_details[] = $museum_details;
        }
        
        return view('wad2.user.account',
            [
                'user'                              => $user, 
                'artworks'                          => $artworks, 
                'museum_artists_involvement'        => $museum_artists_involvement, 
                'user_ranking'                      => $user_ranking, 
                'events_details'                    => $events_details, 
            ]);

    }

    /**
     * Show the form for editing artworks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editArtwork($user_id, $artwork_id)
    {
        $artwork = Artwork::where('id', $artwork_id)->first();

        return view('wad2.artwork.edit',
            [
                'user_id'                   => $user_id,
                'artwork'                   => $artwork,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArtworkEdit(Request $request, $user_id, $artwork_id)
    {
        $custom_error = [
            'title.required'                => "The title of the artwork is required.",
            'description.required'          => "The description of the artwork is required.",
        ];

        $validator = $request->validate([
            'title'                     => ['required'],
            'description'               => ['required'],
        ], $custom_error);

        $artwork_edit = Artwork::where('id', $artwork_id)->update(
            [
                'title'             => trim($request->input('title')),
                'description'       => trim($request->input('description')),
            ]
        );

        if (!$artwork_edit) {
            return redirect()->back()->withErrors(['artwork_error' => 'Something went wrong while trying to edit this artwork. Please try again.']);
        }

        $user = User::where('id', $user_id)->first();

        $artworks = $user->artwork;

        $museum_artists_involvement = $user->museum_artist;

        $artwork_rankings = Artwork::orderBy('votes', 'DESC')->get();

        $user_ranking = 1;
        foreach ($artwork_rankings as $artwork_ranking) {
            if ($artwork_ranking->artist_id == $user_id) {
                break;
            }
            else {
                $user_ranking++;
            }
        }

        $events_details = [];

        foreach ($museum_artists_involvement as $involvement) {
            $museum = $involvement->museum;

            $museum_details = new stdClass();
            $museum_details->museum_name = $museum->name;
            $museum_details->long = $museum->long;
            $museum_details->lat = $museum->lat;

            $artwork_urls = [];
            foreach ($artwork_rankings as $artwork) {
                $artwork_urls[] = $artwork->asset->asset_url;
            }

            $museum_details->images_list = $artwork_urls;

            $events_details[] = $museum_details;
        }
        
        return view('wad2.user.account',
            [
                'user'                              => $user, 
                'artworks'                          => $artworks, 
                'museum_artists_involvement'        => $museum_artists_involvement, 
                'user_ranking'                      => $user_ranking, 
                'events_details'                    => $events_details, 
            ]);

    }
}
