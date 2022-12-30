<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Imports\UsersImport;
USE App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        error_log('halo');
        $students = new Student;
        $students = Student::paginate(10);
        $students = StudentResource::collection($students);
        return response()->json(['students' => $students]);
        //  return Student::all();
    }
    public function search(Request $request)
   {
        error_log('halo');  
        $students = new Student;
        $src = $request->search;
        if($src == '' || $src == null){
       
            return response()->json(['error' => 'Please provide a search term.']);
        }else{
            $students = Student::where('name', 'like','%' . $src . '%')
            ->orWhere('email', 'like','%' . $src . '%')->get();
           
            return response()->json(['students'=>$students]);
        }
   }
   public function import(Request $request) 
   {
       Excel::import(new UsersImport, $request->file('file'));
       
       return redirect('/')->with('success', 'All good!');
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
