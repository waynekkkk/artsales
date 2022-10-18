<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Gallery;
use App\Models\GalleryArtwork;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
    public function add()
    {
        return view('wad2.gallery.add-gallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAdd(Request $request, $user_id)
    {
        $custom_error = [
            'name.required'         => "The name of the gallery is required.",
            'artworks.mimes'        => "Only png, jpg or jpeg files are allowed.",
        ];

        $validator = $request->validate([
            'name'               => ['required'],
            'artworks'           => ['nullable'],
        ], $custom_error);

        $gallery_add = Gallery::create(
            [
                'name'              => trim($request->input('name')),
                'owner_id'          => $user_id,
            ]
        );

        // $artworks = $request->file('artworks');

        // if ($request->hasFile('artworks')) {
        //     foreach ($artworks as $key=>$file) {
        //         try {
        //             $blob_controller = new BlobController();
        //             $artwork = $blob_controller->uploadImages($file);
        //             $artwork_url = json_decode($artwork->getContent())->url;
        //         } catch (Exception $e) {
        //             return redirect()->back()->with('error', 'Something went wrong while uploading your artwork!')->withInput();
        //         }

        //         // creates asset for session picture
        //         $artwork_upload = Asset::create([
        //             'asset_url'             => $artwork_url
        //         ]);

        //         $asset_id_artwork = $artwork_upload->id;

        //         $gallery_artwork_add = GalleryArtwork::create(
        //             [
        //                 'gallery_id'          => $gallery_add->id,
        //                 'artwork_id'          => $asset_id_artwork,
        //             ]
        //         );
        //     }
            
        // }
        
        return "done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
