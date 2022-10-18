<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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
            'email'              => ['required', 'email', 'unique:users'],
            'profile_picture'    => ['nullable', 'mimes:jpg,jpeg,png'],
        ], $custom_error);

        $profile_picture = $request->file('profile_picture');

        if (is_uploaded_file($profile_picture)) {
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
        else {
            $user_add = User::where('id', $id)->update(
                [
                    'name'              => trim($request->input('name')),
                    'email'             => trim($request->input('email')),
                ]
            );
        }
        
        return "done";
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
