<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Input;
use Validator;

class SubjectController extends Controller
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
    public function index()
    {
        //
        return view('newsubject');
    }

    protected function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required'],
            'code' => ['required', 'regex:/^IK-[A-Z][A-Z][A-Z][0-9][0-9][0-9]$/'],
            'credit' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return redirect('/newsubject')->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();
            $user = \Auth::user();
            Subject::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'code' => $data['code'],
                'credit' => $data['credit'],
                'teacherID' => $user->id,
                'published' => 0,
                'studentIDs' => array(),
            ]);
            $subjectID = Subject::where('code', $data['code'])->first()->id;
            $user->subjectIDs = array_merge($user->subjectIDs, array($subjectID));
        }
        return redirect('/teacherhome');
    }

    public function publish(Request $req) {
        $data = $req->all();
        $s = Subject::find($data['id']);
        $s->published = $data['published'];
        $s->save();
        return redirect('/teacherhome');
    }

    public function show(int $id)
    {
        $subject = Subject::find($id);
        return view('subjects')->with('subject', $subject);
    }

    
    public function edit(int $id) {
        $s = Subject::find($id);
        return view('updatesubject')->with('s', $s);
    }

    public function update(Request $req, int $id)
    {
        $data;
        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required'],
            'code' => ['required', 'regex:/^IK-[A-Z][A-Z][A-Z][0-9][0-9][0-9]$/'],
            'credit' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return redirect('/newsubject/update')->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();
            $subject = Subject::find($id);
            $subject->name = $data['name'];
            $subject->description = $data['description'];
            $subject->code = $data['code'];
            $subject->credit = $data['credit'];
            $subject->save();
        }
        return redirect("/subjects/{$subject->id}");
    }

    /*
    public function update(Request $request, Subject $subject)
    {
        $data;
        var_dump($subject);
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required'],
            'code' => ['required', 'regex:/^IK-[A-Z][A-Z][A-Z][0-9][0-9][0-9]$/'],
            'credit' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return redirect('/newsubject/update')->withErrors($validator)->withInput();
        } else {
            $data = $validator->validated();
            $subject
            ->update([['name' => $data['name']], ['description' => $data['description']], ['code' => $data['code']], ['credit' => $data['credit']]]);
        }
        return redirect(`/subjects/{$subject->id}`);
    }
    */
}
