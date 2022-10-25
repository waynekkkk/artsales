<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Gallery;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $notifications = Notification::where('user_id', $user_id)
                                    ->where('is_read', 0)
                                    ->get();

        $current_time = Carbon::now()->timezone('Asia/Singapore')->format('d-M-Y H:i');

        $all_notifications = [];
        foreach ($notifications as $notification) {
            $notification_details = new stdClass();
            $notification_details->id = $notification->id;
            $notification_details->description = $notification->description;
            $notification_details->artwork_id = $notification->artwork_id ? Artwork::where('id', $notification->artwork_id)->first() : null;

            $notification_details->user_pic = User::where('id', $notification->user_id)->first()->profile_picture ? User::where('id', $notification->user_id)->first()->profile_picture->asset_url : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU';

            $datetime_created = Carbon::parse($notification->created_at);
            $diff_min = $datetime_created->diffInMinutes($current_time);

            $notification_details->timestamp = $diff_min;

            $all_notifications[] = $notification_details;
        }

        return view('wad2.user.notification',
        [
            'notifications'                              => $all_notifications, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAdd(Request $request, $user_id)
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
