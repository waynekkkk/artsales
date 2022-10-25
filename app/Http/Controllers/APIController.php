<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use stdClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function postLike(Request $request)
    {
        try {
            $custom_error = [
                'user_id.required'          => 'Please log in to start casting your votes!',
                'artwork_id.required'       => 'Please vote for an artwork!',
            ];

            $validator = $request->validate([
                'user_id'           => ['required'],
                'artwork_id'        => ['required'],
            ]);
        } catch (ValidationException $ve) {
            return response()->json([
                'message' => $ve->errors()
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }

        $artwork = Artwork::where('id', $request->input('artwork_id'))->first();
        $artist = $artwork->artist;

        $current_votes = $artwork->votes;
        $new_votes = $current_votes + 1;
    
        $artwork_update = $artwork->update(
            [
                'votes'         => $new_votes
            ]
        );

        if (!$artwork_update) {
            return response()->json([
                'message' => "Something went wrong while trying to vote for this artwork. Please try again.",
            ], 400);
        }

        $voter = User::where('id', $request->input('user_id'))->first();

        $like_notification_new = Notification::create(
            [
                'description'           => "$voter->name has voted for your artwork \"$artwork->title\"!",
                'artwork_id'            => $request->input('artwork_id'),
                'user_id'               => $artist->id,
            ]
            );

        return response()->json([
            'message' => "Voted!",
            'result' => $new_votes,
        ], 200);
    }

    public function postRead(Request $request)
    {
        try {
            $custom_error = [
                'notification_id.required'          => 'Invalid notification ID!',
            ];

            $validator = $request->validate([
                'notification_id'           => ['required'],
            ]);
        } catch (ValidationException $ve) {
            return response()->json([
                'message' => $ve->errors()
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }

        $notification_to_read = Notification::where('id', $request->input('notification_id'))->first();

        $notification_update = $notification_to_read->update(
            [
                'is_read'         => 1
            ]
        );

        if (!$notification_update) {
            return response()->json([
                'message' => "Something went wrong while trying to update this notification. Please try again.",
            ], 400);
        }

        return response()->json([
            'message' => "Successfully read this notification!",
        ], 200);
    }

}