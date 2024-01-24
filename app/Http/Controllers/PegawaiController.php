<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('index',['judul'=> 'Halaman Home']);
    }
    public function add()
    {
        return view('add',['judul'=> 'Halaman Tambah']);
    }
    public function store(Request $request)
    {
        $foto = str_replace('profil/', '', $request->file('foto')->store('profil'));
        Pegawai::Create(array_merge($request->all(), [
            'foto'     => $foto,
        ]));
        return redirect('/')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }
    
    public function update(Pegawai $pegawai,Request $request)
    {
        $foto = $pegawai->foto;
        if ($request->file('foto')) {
            if ($foto) {
                Storage::delete('profil/' . $foto);
            }
            $foto = str_replace('profil/', '', $request->file('foto')->store('profil'));
        }
                
        $pegawai->update(array_merge($request->all(), [
            'foto'     => $foto,
        ]));
        return redirect('/detail/'.$pegawai->id)->with('success', 'Data Pegawai Berhasil Diedit');
    }
    public function delete(Pegawai $pegawai)
    {
        $berkas = Berkas::where('pegawai_id',$pegawai->id)->first();
        if($berkas){
            Berkas::where('pegawai_id',$berkas->pegawai_id)->delete();
        }
        $pegawai->delete();
   
        return redirect('/')->with('success', 'Data Pegawai Dengan Nama '.$pegawai->nama.' Berhasil Dihapus');
    }
    public function detail(Pegawai $pegawai)
    {
        return view('detail',[
            'judul' => 'Halaman Detail Pegawai',
            'pegawai' => $pegawai,
        ]);
    }

    public function hapus_berkas(Berkas $berkas)
    {
        Storage::delete('berkas/' . $berkas->berkas);
        $berkas->delete();
   
        return redirect('/detail/'.$berkas->pegawai_id )->with('success', 'Data Berkas Id '.$berkas->id.' Berhasil Dihapus');
 
    }
    public function hapus_all(Berkas $berkas)
    {
        $data = Berkas::where('pegawai_id',$berkas->pegawai_id)->get();
        foreach ($data as $item) {
            Storage::delete('berkas/' . $item->berkas);
            $item->delete();
        }
        
        return redirect('/detail/'.$berkas->pegawai_id )->with('success', 'Data Berkas Id Pegawai '.$berkas->pegawai_id.' Berhasil Dihapus');
 
    }
    public function berkas($id, Request $request)
    {
        $image = $request->file('file');
   
        $imageName = str_replace('berkas/', '', $image->store('berkas'));
        Berkas::create([
            'pegawai_id' => $id,
            'berkas' => $imageName,
        ]);
   
        return response()->json(['success'=> $imageName]);
 
    }
}
