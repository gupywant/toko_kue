<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\JenisKue;
use App\Model\Kue;

class userHomeController extends Controller
{
    public function index(Request $request){
    	$query = Kue::selectRaw('kue.*,(select gambar from kue_gambar a where id_gambar = (select min(id_gambar) from kue_gambar where id_kue = kue.id_kue )) as gambar,jenis_kue.nama as nama_jenis')->leftJoin('jenis_kue','jenis_kue.id_jenis','=','kue.id_jenis');
    	if(!empty($request->kat) and !empty($request->cari)){
    		$query = $query->where('kue.nama','like',"%$request->cari%")->paginate(8)->appends([['kat' => $request->kat],['cari' => $request->cari]]);
    		$data['kat'] = $request->kat;
    		$data['cari'] = $request->cari;
    	}else if(!empty($request->kat)){
    		$query = $query->where('kue.id_jenis',$request->kat)->paginate(2)->appends(['kat' => $request->kat]);
    		$data['kat'] = $request->kat;
    		$data['cari'] = null;
    	}
    	else if(!empty($request->cari)){
    		$query = $query->where('kue.nama','like',"%$request->cari%")->paginate(8)->appends(['cari' => $request->cari]);
    		$data['cari'] = $request->cari;
    		$data['kat'] = "x";
    	}else{
    		$query = $query->paginate(8);
    		$data['cari'] = null;
    		$data['kat'] = "x";
    	}
    	$data['jenis'] = JenisKue::all();
    	$data['kue'] = $query;

    	return view('user.home',$data);
    }
    public function productIndex(Request $request){
    	return view('user.productPage');
    }
    public function checkoutIndex(Request $request){
    	return view('user.checkout');
    }
}
