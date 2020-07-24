<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\JenisKue;
use App\Model\User;
use App\Model\Kue;
use App\Model\KueOrder;
use App\Model\KueGambar;
use Session;

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
    public function productIndex($id){
        $kue = Kue::selectRaw('kue.*,(select gambar from kue_gambar a where id_gambar = (select min(id_gambar) from kue_gambar where id_kue = kue.id_kue )) as gambar,jenis_kue.nama as nama_jenis')->leftJoin('jenis_kue','jenis_kue.id_jenis','=','kue.id_jenis')->where('id_kue',$id)->first();
        $data['kue'] = $kue;
        $data['gambar'] = KueGambar::where('id_kue',$id)->get();
        $data['jenis'] = JenisKue::where('id_jenis',$kue->id_jenis)->first();
    	return view('user.productPage',$data);
    }

    public function checkoutIndex(Request $request,$id){
        $data['user'] = User::where('username',Session::get('username'))->first();
        $data['jumlah'] = $request->jumlah;
        $data['kue'] = Kue::where('id_kue',$id)->first();
    	return view('user.checkout',$data);
    }

    public function checkoutProses(Request $request,$id){
        $find = User::where('username',Session::get('username'))->first();
        $kode = str_pad(mt_rand(1,99999999),12,'0',STR_PAD_LEFT);
        $new = new KueOrder;
        $new->id_kue = $id;
        $new->id_user = $find->id_user;
        $new->jumlah = $request->jumlah;
        $new->kode = $kode;
        $new->status = 0;
        $new->save();
        return redirect(route('user.orderUser'))->with('order',$kode);
    }

    public function checkoutIndexGet(){
        return redirect(route('user.home'));
    }

    public function orderUser(Request $request){
        $find = User::where('username',Session::get('username'))->first();
        $data['inorder'] = KueOrder::where([['kue_order.id_user',$find->id_user],['status','<=',1]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['onproses'] = KueOrder::where([['kue_order.id_user',$find->id_user],['status','=',2]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['finish'] = KueOrder::where([['kue_order.id_user',$find->id_user],['status','=',3]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['tabel'] = true;
        return view('user.order',$data);
    }
}
