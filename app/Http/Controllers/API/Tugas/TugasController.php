<?php

namespace App\Http\Controllers\API\Tugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    //
    public function store(Request $request){
        $validateData=$request->validate([
            'id'=>'required',
            'nama_tugas'=>'required'
            
        ]);
    }
}
