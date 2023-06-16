<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTaskInfoRequest;
use App\Models\Task;
use App\Models\TaskInfo;
use App\Models\TaskInfoTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskInfoController extends BaseController
{
    private $tasks;

    public function __construct(){
        $this->tasks = Task::all();
    }

    public function index(Task $tasks)
    {
        $tasks = $tasks->newQuery();

        $tasks = $tasks->paginate(10)->withQueryString();

        $this->data['tasks'] = $tasks;

        return view('admin.pages.task-info.index', $this->data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Task $tasks)
    {
        $task = Task::find($id);
        $task_info = TaskInfo::where('task_id',$id)->first();

        $translations = $task_info->translations;

        foreach ($translations as $translation){
            if($translation->language_id == 2){
                //srb
                $srb_translation = $translation;
            }
        }

        $this->data['task_info'] = $task_info;
        $this->data['tasks'] = $tasks->get();
        $this->data['task'] = $task;
        $this->data['srb_translation'] = $srb_translation;

        if($task){
            return view('admin.pages.task-info.edit', $this->data);
        }
        else{
            return back();
        }
    }

    public function update(EditTaskInfoRequest $request, $id)
    {
        try {
            $intro= $request->get('intro');
            $text = $request->get('text');
            $srb_intro = $request->get('srb_intro');
            $srb_text = $request->get('srb_text');

            $task_info = TaskInfo::find($id);

            $task_info->intro = $intro;
            $task_info->text = $text;
            $task_info->save();

            $translation = TaskInfoTranslation::where('task_info_id',$task_info->id)
                ->where('language_id',2)->first(); //serbian
            $translation->intro = $srb_intro;
            $translation->text = $srb_text;
            $translation->save();

            return redirect()->route('task-info.index')->with("success", "Successfully edited.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex);
        }
    }

    public function destroy($id)
    {
        //
    }
}
