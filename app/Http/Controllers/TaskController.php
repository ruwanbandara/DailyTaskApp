<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tasktest;

class TaskController extends Controller
{
    public function store(Request $request){

        //dd($request->all());
        $task=new tasktest;

        $this->validate($request,[
            'task'=>'required|max:100|min:5',
        ]);

        $task->task=$request->task;
        $task->save();

        $data=tasktest::all();
        //dd($data);
        return redirect('tasks')->with('tasks',$data);

         
       // return redirect()->back();

    }

    public function UpdateTaskAsCompleted($id){

    $task=tasktest::find($id);
    $task->iscompleted=1;
    $task->save();
    return redirect()->back();
    }

    public function UpdateTaskAsNotCompleted($id){
    $task=tasktest::find($id);
    $task->iscompleted=0;
    $task->save();
    return redirect()->back();
        
    }
    public function deletetask($id){
        $task=tasktest::find($id);
        $task->delete();
        return redirect()->back(); 
            

    }
    public function updatetaskview($id){
        $task=tasktest::find($id);

        return view('updatetask')->with('taskdata',$task);
         

    }

    public function updatetask(Request $request){
        //dd($request);
        $id=$request->id;
        $task=$request->task;
        $data=tasktest::find($id);
        $data->task=$task;
        $data->save();
        $datas=tasktest::all();

        return redirect('tasks')->with('tasks',$datas);

       // return redirect()->back();

    }
}
