<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Asset;
use App\Models\Museum;
use App\Models\MuseumArtist;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
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
        $profile_picture = $user->profile_picture;
        $banner = $user->banner;

        return view('wad2.user.edit',
            [
                'user'                    => $user, 
                'profile_picture'         => $profile_picture, 
                'banner'                  => $banner, 
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
            'profile_picture'    => ['nullable', 'mimes:jpg,jpeg,png,gif'],
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
            'artwork'               => ['required', 'mimes:jpg,jpeg,png,gif', 'dimensions:min_width=1080,min_height=1080,max_width=1080,max_height=1080'],
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
        $artwork = Artwork::where('id', $artwork_id)->first();

        $noti_w_artwork = $artwork->notification;

        if ($noti_w_artwork) {
            foreach ($noti_w_artwork as $noti) {
                $noti_delete = $noti->delete();
            }
        }

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
     * Update the specified artwork in storage.
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

    /**
     * Show the form for adding artworks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addEvent($user_id)
    {
        $museums = Museum::all();

        $museums_w_id = new stdClass();
        foreach ($museums as $museum) {
            $id = $museum->id;

            $museum_details = new stdClass();
            $museum_details->name = $museum->name;
            $museum_details->lat = $museum->lat;
            $museum_details->long = $museum->long;

            $museums_w_id->$id = $museum_details;
        }

        return view('wad2.user.user_event_add',
            [
                'user_id'                   => $user_id,
                'museums'                   => $museums,
                'museums_w_id'              => $museums_w_id,
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
    public function updateEventAdd(Request $request, $user_id)
    {
        $custom_error = [
            'museum_id.required'                    => "A museum has to be selected in order to join an event.",
            'datetime_start.required'               => "A date and time for the event's start is needed.",
            'datetime_end.required'                 => "A date and time for the event's end is needed.",
            'datetime_end.after'                    => "The date and time for the end of the event must be before its starting date and time.",
        ];

        $validator = $request->validate([
            'museum_id'                      => ['required'],
            'datetime_start'                 => ['required', 'date'],
            'datetime_end'                   => ['required', 'date', 'after:datetime_start'],
        ], $custom_error);

        $datetime_start = Carbon::parse($request->input('datetime_start'));
        $datetime_end = Carbon::parse($request->input('datetime_end'));

        $datetime_start_format = $datetime_start->format('d M Y H:i');
        $datetime_end_format = $datetime_end->format('d M Y H:i');

        $museum_artist_exists = MuseumArtist::where('museum_id', $request->input('museum_id'))
                                            ->where('user_id', $user_id)
                                            ->exists();

        if ($museum_artist_exists) {
            $museum_artist_current = MuseumArtist::where('museum_id', $request->input('museum_id'))
                                            ->where('user_id', $user_id)
                                            ->first();

            $museum_artist_current_start = Carbon::parse($museum_artist_current->datetime_start)->format('d M Y H:i');
            $museum_artist_current_end = Carbon::parse($museum_artist_current->datetime_end)->format('d M Y H:i');
            
            if (($datetime_start_format >= $museum_artist_current_start) && ($datetime_start_format <= $museum_artist_current_end)) {
                return redirect()->back()->with('invalid_date', 'Shucks! You have another event here that clashes with your new start and end datetime!')->withInput();
            }
        }

        $musuem_artist_add = MuseumArtist::create(
            [
                'museum_id'             => $request->input('museum_id'),
                'user_id'               => $user_id,
                'datetime_start'        => $datetime_start,
                'datetime_end'          => $datetime_end,
            ]
        );

        $museum = Museum::where('id', $request->input('museum_id'))->first();
        $user = User::where('id', $user_id)->first();

        foreach (User::all() as $user_to_notify) {
            if ($user_to_notify->id != $user_id) {
                $new_artwork_notification = Notification::create(
                    [
                        'description'           => "$user->name will be taking part in an event at $museum->name from $datetime_start_format H to $datetime_end_format H!",
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

    public function destroyEvent($user_id)
    {
        $museum_artists = MuseumArtist::where('user_id', $user_id)->get();

        return view('wad2.user.destroy_event',
            [
                'user_id'                   => $user_id,
                'events'                    => $museum_artists
            ]
        );
    }

    public function destroyEventUpdate(Request $request, $user_id)
    {
        $custom_error = [
            'event_id.required'                    => "An event is required for us to remove you from it",
        ];

        $validator = $request->validate([
            'event_id'                      => ['required'],
        ], $custom_error);

        $event_id = $request->input('event_id');

        $museum_artist = MuseumArtist::where('id', $event_id)->first();
        $museum = $museum_artist->museum->name;

        $datetime_start = Carbon::parse($museum_artist->datetime_start);
        $datetime_end = Carbon::parse($museum_artist->datetime_end);

        $datetime_start_format = $datetime_start->format('d M Y H:i');
        $datetime_end_format = $datetime_end->format('d M Y H:i');

        $user = User::where('id', $user_id)->first();

        foreach (User::all() as $user_to_notify) {
            if ($user_to_notify->id != $user_id) {
                $delete_event_notification = Notification::create(
                    [
                        'description'           => "$user->name will be ceasing participation of the event at $museum from $datetime_start_format H to $datetime_end_format H!",
                        'user_id'               => $user_to_notify->id,
                    ]
                );
            }
        }

        $museum_artist_delete = MuseumArtist::where('id', $event_id)->delete();
        
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
