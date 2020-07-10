<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kue;
use App\Model\KueGambar;
use App\Model\JenisKue;
use File;

class kueController extends Controller
{
    public function kueList(){
        $data['table'] = true;
    	$data['kue'] = Kue::selectRaw('kue.*,(select gambar from kue_gambar a where id_gambar = (select min(id_gambar) from kue_gambar where id_kue = kue.id_kue )) as gambar,jenis_kue.nama as nama_jenis')->leftJoin('jenis_kue','jenis_kue.id_jenis','=','kue.id_jenis')->get();;
    	return view('admin.kueList',$data);
    }

    public function kueAdd(){
    	$data['jenis'] = jenisKue::all();
    	return view('admin.kueAdd',$data);
    }

    public function hapus($id){
    	KueGambar::where('id_kue',$id)->delete();
    	Kue::where('id_kue',$id)->delete();

    	return back()->with('message','Kue berhasil dihapus');
    }

    public function tambah(Request $request){

        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');

        //tambah kue
        $add = new Kue;
        $add->nama = $request->nama;
        $add->id_jenis = $request->jenis;
        $add->harga = $request->harga;
        $add->waktu_po = $request->po;
        $add->deskripsi = $request->descriptions;
        $add->updated_at = $date;
        $add->created_at = $date;
        $add->save();

        //add image
        $allFile = $request->file('foto');
        if(!empty($request->foto)){
            foreach ($request->foto as $key => $data) {
                $file = $allFile[$key];
                //image check
                $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                $contentType = $file->getClientMimeType();

                if(! in_array($contentType, $allowedMimeTypes) ){
                    return back()->with('alert','Upload Hanya gambar');
                }

                $path = public_path().'/filesdat/'.$add->id;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }

                $file->move($path,$file->getClientOriginalName());

                $addImage = new KueGambar;
                $addImage->id_kue = $add->id;
                $addImage->gambar = $file->getClientOriginalName();
                $addImage->updated_at = $date;
                $addImage->created_at = $date;
                $addImage->save();
            }
        }

        return back()->with('message','Kue berhasil ditambah');

    }

    public function jenisList(){
        $data['table'] = true;
    	$data['jenis'] = JenisKue::all();
    	return view('admin.jenisKue',$data);
    }

    public function jenisEdit(Request $request,$id){
        date_default_timezone_set("Asia/jakarta");
        $date = Date('Y-m-d H:i:s');

        $update = array(
        	"nama" => $request->nama,
        	"deskripsi" => $request->deskripsi,
        	"updated_at" => $date
        );

        JenisKue::where('id_jenis',$id)->update($update);

        return back()->with('message','Jenis berhasil diedit');
     }

    public function jenisTambah(Request $request){
        date_default_timezone_set("Asia/jakarta");
        $date = Date('Y-m-d H:i:s');

        $add = new JenisKue;
        $add->nama = $request->nama;
        $add->deskripsi = $request->deskripsi;
        $add->updated_at = $date;
        $add->created_at = $date;
        $add->save();

        return back()->with('message','Jenis berhasil ditambah');
    }
}