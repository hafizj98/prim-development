<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asrama;
use DB; 

class AsramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $asrama1 = Asrama::all();

        // $asrama = DB::table('asramas')
        // ->join('students', 'students.id', '=', 'asramas.student_id')
        // ->select('asramas.*', 'students.*')
        // ->get();

        $asrama = DB::table('students')
        ->join('asramas', 'asramas.student_id', '=', 'students.id')
        ->select('students.*', 'asramas.*')
        ->get();
        return view('asrama.index', compact('asrama'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = DB::table('students')
        ->where('id', 1)
        ->first();

        if(is_null($users))
        {
            
        }
        else{
            return view('asrama.create', compact('users'));
        }
        
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
        $validateData = $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'reason' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $show = Asrama::create($validateData);
        return redirect('/asrama')->with('success', 'Application saved');
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
        $asrama = Asrama::findOrFail($id);
        $asrama->update(array('status' => '1'));

        // DB::table('asramas')
        // ->where('student_id',$id)
        // ->update([
        //     'status' =>$request->get('status'),
        // ]);
        
        return redirect('/asrama')->with('success', 'Application Data is successfully updated');
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
        $validatedData = $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'reason' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        Asrama::whereId($id)->update($validatedData);

        return redirect('/asrama')->with('success', 'Data is successfully updated');
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
        // $asrama = Asrama::findOrFail($id);
        // $asrama->delete();
        // dd($id);
        DB::table('asramas')
            ->where('id',$id)
            ->delete();
        return redirect('/asrama')->with('success', 'Application Data is successfully deleted');
    }
}