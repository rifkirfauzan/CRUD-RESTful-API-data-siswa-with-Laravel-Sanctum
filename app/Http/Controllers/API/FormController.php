<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);

        //proses isi data
        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_telp = $request->no_telp;
        $student->save();

        return response()->json([
            'message'=>'Data berhasil disimpan',
            'data_student'=> $student
        ],200);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json([
            'message'=>'Success',
            'data_student'=> $student
        ],200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);

        $student->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ]);

        return response()->json([
            'message'=>'Success',
            'data_student'=> $student
        ],200);
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();
        return response()->json([
            'message'=>'Data berhasil dihapus',
        ],200);
    }
}
