<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskCreateRequest;

use function PHPSTORM_META\type;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Task::orderBy('updated_at', 'desc')->paginate(20);
        return view('admin.task.list',compact('tasks'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks=Task::get();
        return view('admin.task.create',compact('tasks'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request,Task $task)
    {
         //ARRAY TO STRİNG
        if($request->task_type=='custom_ops'){
            $task->country= $request->country;
        }
        else if($request->task_type=='invoice_ops'){
            $task->amount=$request->currency.$request->quantity;
        }
        $task->task_name=$request->task_name;
        $task->task_type=$request->task_type;
        $request->prerequisites = implode(", ",$request->prerequisites);
        $task->prerequisites=$request->prerequisites;

        $task->save();
        return redirect()->route('tasks.index')->withSuccess('Task saved.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task=Task::find($id) ?? abort(404,'Task Not Found');
        $prereq=explode(", ",$task->prerequisites);
        $durum="false";
        $errors="";

        if($task->task_status=="Progress"){
            $task->update(['task_status'=>'Finished']);
            return redirect()->route('tasks.index')->withSuccess('Task Finished.');
        }
        else{

            foreach ($prereq as $task_id) {
                if($task_id == "none"){
                    $durum="true";
                    break;
                }
                else{
                    $tasks=Task::find($task_id);
                }
                if($tasks->task_status != "Finished")
                {
                    $durum="false";
                    $errors="You must finished ".$tasks->task_name." Task";
                    break;
                }
                else{
                    $durum="true";
                }
            }
            if($durum=="true"){
                $task->update(['task_status'=>'Progress']);
                return redirect()->route('tasks.index')->withSuccess('Task started.');
            }
            else
            {
                return redirect()->route('tasks.index')->withErrors($errors);
            }
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::find($id) ?? abort(404,'Task Not Found');
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
