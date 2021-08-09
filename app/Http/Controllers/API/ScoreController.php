<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function create(Request $request)
    {
        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_telp = $request->no_telp;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value)
        {
            $score = array(
                'student_id'=> $student->id,
                'mata_pelajaran'=>$value['mata_pelajaran'],
                'nilai'=>$value['nilai']
            );
            $scores = Score::create($score);
        }

        return response()->json([
            'message'=>'Success',
        ],200);
    }

    public function getStudent($id)
    {
        $student = Student::with('score')->where('id',$id)->first();
        return response()->json([
            'message'=>'Success',
            'data_student'=>$student
        ],200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        Score::where('student_id', $id)->delete();

        foreach ($request->list_pelajaran as $key => $value)
        {
            $score = array(
                'student_id'=> $id,
                'mata_pelajaran'=>$value['mata_pelajaran'],
                'nilai'=>$value['nilai']
            );
            $scores = Score::create($score);
        }

        return response()->json([
            'message'=>'Success',
        ],200);

    }
}