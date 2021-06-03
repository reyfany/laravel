<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Task;
use App\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename='Data Sekolah';
        $data = Sekolah::all();
        return view('admin.sekolah.index', compact('data', 'pagename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pagename='Form Input Sekolah';
        return view('admin.sekolah.create', compact('pagename')); //memberi view dari admintuags kategri.
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
            'txtnama_sekolah'=>'required',
            'txtkode_sekolah'=>'required',
            'txtnama_kepala'=>'required',
        ]);

        //membuat objek dari sebuah class yang bernama Task
        $sekolah = new Sekolah([
            
            //data seblum dikirim harus di packing kedalam satu clas, agar pengiriman 
            'nama_sekolah'=> $request ->get('txtnama_sekolah'),
            'kode_sekolah'=> $request ->get('txtkode_sekolah'), 
            'nama_kepala'=> $request ->get('txtnama_kepala'),
        ]);

        //data yang di form sudah masuk kedalam phpmyadmin dan belum bisa menampilkan datanya
        $sekolah->save();

        // mengarahkan ke admin tugas otomatis mencari index
        return redirect('admin/sekolah')->with('sukses', 'sekolah berhasil disimpan');
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
        $pagename='Update Sekolah';
        $data= Sekolah::Find($id);
        return view('admin.sekolah.edit', compact('data', 'pagename'));
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
            'txtnama_sekolah'=>'required',
            'txtkode_sekolah'=>'required',
            'txtnama_kepala'=>'required',
        ]);

            $sekolah= Sekolah::find($id);

            $sekolah->nama_sekolah = $request ->get('txtnama_sekolah');
            $sekolah->kode_sekolah = $request ->get('txtkode_sekolah'); 
            $sekolah->nama_kepala = $request ->get('txtnama_kepala');
       

        $sekolah->save();
        return redirect('admin/sekolah')->with('sukses', 'sekolah berhasil diupdate');
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
        $sekolah = Sekolah::find($id);
        $sekolah->delete();
        return redirect('admin/sekolah')->with('sukses', 'sekolahberhasil dihapus');
    }
}
