<?php

namespace App\Http\Controllers;
// hello joel you are sexy
use Illuminate\Http\Request;
use App\Models\Task;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidationRequest;
use App\Models\Asset;
use Exception;

// hi
class TaskController extends Controller
{
    public function index(){

        $tasks = Task::all();

        return view('tasks.index', ['tasks'=>$tasks]);
    }

    public function add(){
        return view('tasks.add');
    }

    public function create(Request $request){

        $request->validate([
            'description' => 'required',
            'user_id' => 'required',
            'img' => 'mimes:jpg,jpeg,png'
        ]);
        
        $picture = $request->input('img');

        try {
            $blob_controller = new BlobController();
            $session_picture = $blob_controller->uploadImage($request, 'img');
            $session_picture_url = json_decode($session_picture->getContent())->url;
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while uploading the session picture!')->withInput();
        }

        // creates asset for session picture
        $event_session_picture = Asset::create([
            'asset_url'             => $session_picture_url
        ]);

        $asset_id_session_picture = $event_session_picture->id;
           
        $task_add = Task::create(
            [
                'description'       => trim($request->input('description')),
                'user_id'           => trim($request->input('user_id')),
                'img_path'          => $session_picture_url,
            ]
        );

        return redirect()->route('mainpage');
    }

    public function edit($id){

        $task = Task::where('id',$id)->first();

        return view('tasks.edit')->with('task', $task );
    }

    public function update(Request $request, $id){

        $request->validate([
            'description' => 'required',
            'user_id' => 'required',
            'img' => 'mimes:jpg,jpeg,png'
        ]);

        if (!empty($request->img)){
            $newImgName = time() . '-' . $request->id . '.' . $request->img->extension();

            $request->img->move(public_path('images'), $newImgName);
        }
        else {
            $newImgName = '';
        }

        $task = Task::where('id',$id)
                ->update(['description' => $request->input('description'),
                            'user_id' => $request->input('user_id'),
                            'img_path' => $newImgName]);

        return redirect()->route('mainpage');
    }

    public function delete_id(){
        return view('tasks.delete');
    }

    public function delete2(Request $request){
        $request->validate(['id'=>'required']);

        $id = $request->id;

        return redirect('/delete/'.$id);
    }
    
    public function delete($id){
        $task = Task::where('id',$id)
                ->delete();

        return redirect()->route('mainpage');
    }

    public function view($id){

        $task = Task::where('id',$id)->first();

        return view('tasks.view')->with('task', $task);
    }
}
