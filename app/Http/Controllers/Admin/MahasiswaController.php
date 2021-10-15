<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename='Data Mahasiswa';
        $data = Mahasiswa::all();
        return view('admin.Mahasiswa.index', compact('data', 'pagename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pagename='Form Input Mahasiswa';
        return view('admin.Mahasiswa.create', compact('pagename')); //memberi view dari admintuags kategri.
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
            'txtnama_mahasiswa'=>'required',
            'txtkode_mahasiswa'=>'required',
            'txtnama_ortu'=>'required',
        ]);

        //membuat objek dari sebuah class yang bernama Task
        $mahasiswa = new Mahasiswa([
            
            //data seblum dikirim harus di packing kedalam satu clas, agar pengiriman 
            'nama_mahasiswa'=> $request ->get('txtnama_mahasiswa'),
            'kode_mahasiswa'=> $request ->get('txtkode_mahasiswa'), 
            'nama_ortu'=> $request ->get('txtnama_ortu'),
        ]);

        //data yang di form sudah masuk kedalam phpmyadmin dan belum bisa menampilkan datanya
        $mahasiswa->save();

        // mengarahkan ke admin tugas otomatis mencari index
        return redirect('admin/mahasiswa')->with('sukses', 'Mahasiswa berhasil disimpan');
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
        $pagename='Update Mahasiswa';
        $data= Mahasiswa::Find($id);
        return view('admin.mahasiswa.edit', compact('data', 'pagename'));
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
            'txtnama_mahasiswa'=>'required',
            'txtkode_mahasiswa'=>'required',
            'txtnama_ortu'=>'required',
        ]);

            $Mahasiswa= Mahasiswa::find($id);

            $Mahasiswa->nama_mahasiswa = $request ->get('txtnama_mahasiswa');
            $Mahasiswa->kode_mahasiswa = $request ->get('txtkode_mahasiswa'); 
            $Mahasiswa->nama_ortu = $request ->get('txtnama_ortu');
       

        $Mahasiswa->save();
        return redirect('admin/mahasiswa')->with('sukses', 'Mahasiswa berhasil diupdate');
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
        $Mahasiswa = Mahasiswa::find($id);
        $Mahasiswa->delete();
        return redirect('admin/mahasiswa')->with('sukses', 'Mahasiswaberhasil dihapus');
    }
}
