<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\User;

class TargyLeadFelveszController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function felvesz(Request $req) {
        $data = $req->all();
        $studentID = $data['studentID'];
        $subjectID = $data['subjectID'];
        $student = User::find($studentID);
        $subject = Subject::find($subjectID);
        $student->subjectIDs = array_merge($student->subjectIDs, array($subjectID));
        $subject->studentIDs = array_merge($subject->studentIDs, array($studentID));
        $student->save();
        $subject->save();
        return redirect('/studenthome');
    }

    public function lead(Request $req) {
        $data = $req->all();
        $studentID = $data['studentID'];
        $subjectID = $data['subjectID'];
        $student = User::find($studentID);
        $subject = Subject::find($subjectID);
        $newStudentArray = array();
        $newSubjectArray = array();
        foreach($student->subjectIDs as $subid) {
            if($subjectID != $subid) {
                array_push($newStudentArray, $subid);
            }
        }
        foreach($subject->studentIDs as $stuid) {
            if($stuid != $studentID) {
                array_push($newSubjectArray, $subid);
            }
        }
        $student->subjectIDs = $newStudentArray;
        $subject->studentIDs = $newSubjectArray;
        $student->save();
        $subject->save();
        return redirect('/studenthome');
    }

    public function softdel(Request $req) {
        $data = $req->all();
        $tobedeleted = Subject::find($data['subID']);
        $tobedeleted->delete();
        return redirect('/teacherhome');
    }
}
