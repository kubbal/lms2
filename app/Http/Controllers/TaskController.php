<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Task;
use App\Solution;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Input;
use Validator;
use Storage;

class TaskController extends Controller
{

    protected $redirectTo = RouteServiceProvider::THOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        $data = $req->all();
        return view('newtask')->with('subid', $data['subid']);
    }

    public function indexGetMethod($id)
    {
        return view('newtask')->with('subid', $id);
    }

    protected function create(Request $req)
    {
        $d = $req->all();
        $validator = Validator::make($d, [
            'name' => ['required', 'min:5'],
            'description' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect("/newtask/{$d['subid']}")->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();
            $user = \Auth::user();
            Task::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'score' => $d['score'],
                'begin' => $d['begin'],
                'end' => $d['end'],
                'subjectID' => $d['subid'],
                'solutionIDs' => array(),
            ]);
            $taskID = Task::where([['name', '=', $data['name']], ['description', '=', $data['description']]])->first()->id;
            $subject = Subject::find($d['subid']);
            if($subject->taskIDs == null) { $subject->taskIDs = array(); }
            $subject->taskIDs = array_merge($subject->taskIDs, array($taskID));
        }
        return redirect("/subjects/{$d['subid']}");
    }

    public function show(int $id)
    {
        $task = Task::find($id);
        return view('tasks')->with('task', $task);
    }

    public function edit(int $id) {
        $task = Task::find($id);
        return view('edittask')->with('task', $task);
    }

    public function update(Request $req, int $id)
    {
        $data;
        $d = $req->all();
        $validator = Validator::make($d, [
            'name' => ['required', 'min:5'],
            'description' => ['required'],
        ]);
        $task = Task::find($id);
        if($validator->fails()) {
            return redirect("/tasks/edit/{$task->id}")->withErrors($validator)->withInput()->with('task', $task);
        } else {
            $data = $validator->validated();
            $task->name = $data['name'];
            $task->description = $data['description'];
            $task->score = $d['score'];
            $task->begin = $d['begin'];
            $task->end = $d['end'];
            $task->save();
        }
        return redirect("/tasks/{$task->id}");
    }

    public function bead(Request $req, int $id) {
        $d = $req->all();
        Storage::disk('local')->put($d['file'], 'Contents');
        $validator = Validator::make($d, [
            'solution' => ['required'],
        ]);
        if($validator->fails()) {
            return redirect("/tasks/{$id}")->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();
            $user = \Auth::user();
            Solution::create([
                'solution' => $data['solution'],
                'grade' => null,
                'notes' => null,
                'userID' => $user->id,
                'taskID' => $id,
                'filename' => $d['file'],
            ]);
        }
        return redirect("/tasks/{$id}");
    }

    public function tasklist() {
        return view('activetasklist');
    }
}
