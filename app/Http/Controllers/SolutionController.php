<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solution;
use Validator;

class SolutionController extends Controller
{
    public function edit(int $id) {
        $solution = Solution::find($id);
        return view('grade')->with('solution', $solution);
    }

    public function update(Request $req, int $id)
    {
        $d = $req->all();
        $validator = Validator::make($d, [
            'grade' => ['required'],
        ]);
        $solution = Solution::find($id);
        if($validator->fails()) {
            return redirect("/tasks/edit/{$task->id}")->withErrors($validator)->withInput()->with('solution', $solution);
        } else {
            $data = $validator->validated();
            $solution->grade = $data['grade'];
            if(isset($d['notes'])) {
                $solution->notes = $d['notes'];
            }
            $solution->save();
        }
        return redirect("/tasks/{$solution->taskID}");
    }
}
