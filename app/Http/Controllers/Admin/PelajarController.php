<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\KategoriController;
use App\Pelajar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename='Data Pelajar';
        $data = Pelajar::all();
        return view('admin.pelajar.index', compact('data', 'pagename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        $pagename='Form Input Pelajar';
        return view('admin.pelajar.create', compact('pagename')); //memberi view dari admintuags kategri.
                                          //compact adalah formulir 
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
        // dd($request); kiriman dari form
        // Untuk melihat dan mengecek isi dari requst dan data_tugas

        // rewuired haru diisi semua
        $request->validate([
            'txtnama_mhs'=>'required',
            'txtnim_mhs'=>'required',
            'txtprodi_mhs'=>'required',

        ]);

        //membuat objek dari sebuah class yang bernama Task
        $pelajar = new Pelajar([
            
            //data seblum dikirim harus di packing kedalam satu clas, agar pengiriman 
            'nama_mhs'=> $request ->get('txtnama_mhs'),
            'nim_mhs'=> $request ->get('txtnim_mhs'), 
            'prodi_mhs'=> $request ->get('txtprodi_mhs'),
        ]);

        //data yang di form sudah masuk kedalam phpmyadmin dan belum bisa menampilkan datanya
        $pelajar->save();

        // mengarahkan ke admin tugas otomatis mencari index
        return redirect('admin/pelajar')->with('sukses', 'tugas berhasil disimpan');
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
        $pagename='Update Pelajar';
        $data= Pelajar::Find($id);
        return view('admin.pelajar.edit', compact('data', 'pagename'));
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
        $request->validate([
            'txtnama_mhs'=>'required',
            'txtnim_mhs'=>'required',
            'txtprodi_mhs'=>'required'
        ]);

            $pelajar=Pelajar::find($id);
            $pelajar->nama_mhs = $request ->get('txtnama_mhs');
            $pelajar->nim_mhs = $request ->get('txtnim_mhs'); 
            $pelajar->prodi_mhs = $request ->get('txtprodi_mhs');
       

        $pelajar->save();
        return redirect('admin/pelajar')->with('sukses', 'mahasiswa berhasil diupdate');
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
        $pelajar = Pelajar::find($id);
        $pelajar->delete();
        return redirect('admin/pelajar')->with('sukses', 'tugas berhasil dihapus');
    }
}
