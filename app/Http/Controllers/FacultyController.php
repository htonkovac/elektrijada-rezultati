<?php

namespace App\Http\Controllers;

use App\Faculty;
use Validator, Input, Redirect, Request, Session; 

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();

        return view('faculty.index')->withFaculties($faculties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
            'name'       => 'required|unique:faculties'
        );
        $validator = Validator::make(Request::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('faculty/create')
                ->withErrors($validator->errors()->all());
        } else {
            // store
            $faculty = new Faculty();
            $faculty->name = Request::get('name');
            $faculty->save();

            // redirect
            Session::flash('message', 'Novi fakultet je stvoren!');
            return Redirect::to('faculty');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        return $this->edit($faculty);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.create')->withFaculty($faculty);                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
         
        $rules = array(
            'name'       => 'required|unique:faculties'
        );
        $validator = Validator::make(Request::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('faculty/'.$faculty->id.'/edit')
                ->withErrors($validator->errors()->all());
        } else {

            $faculty->name = Request::get('name');
            $faculty->save();

            Session::flash('message', 'Successfully updated faculty name!');
            return Redirect::to('faculty');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        Session::flash('message', 'Successfully deleted a faculty!');
        
        return Redirect::to('faculty');        
    }
}
