<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\KueOrder;
use App\Model\OrderDetail;

class orderController extends Controller
{
    public function orderBaruList(){
        $data['table'] = true;
    	$data['order'] = KueOrder::select('kue.nama as nama_kue','kue.harga','kue.waktu_po','kue_order.*','user.nama as nama')->leftJoin('kue','kue.id_kue','kue_order.id_kue')->leftJoin('user','user.id_user','kue_order.id_user')->where('kue_order.status',"<=",1)->orderBy('kue_order.created_at','desc')->get();
    	return view('admin.orderBaru',$data);
    }

    public function orderProsesList(){
        $data['table'] = true;
    	$data['order'] = KueOrder::select('kue.nama as nama_kue','kue.harga','kue.waktu_po','kue_order.*','user.*')->leftJoin('kue','kue.id_kue','kue_order.id_kue')->leftJoin('user','user.id_user','kue_order.id_user')->where('kue_order.status',2)->orderBy('kue_order.created_at','desc')->get();
    	return view('admin.orderProses',$data);
    }

    public function orderSelesaiList(){
        $data['table'] = true;
    	$data['order'] = KueOrder::select('kue.nama as nama_kue','kue.harga','kue.waktu_po','kue_order.*','user.*')->leftJoin('kue','kue.id_kue','kue_order.id_kue')->leftJoin('user','user.id_user','kue_order.id_user')->where('kue_order.status',3)->orderBy('kue_order.created_at','desc')->get();    	
        return view('admin.orderSelesai',$data);
    }

    public function orderHapus($id){

        OrderDetail::where('id_order',$id)->delete();
    	KueOrder::where('id_order',$id)->delete();

    	return back()->with('message','Orderan Berhasil dihapus');
    }

    public function statusUpdate(Request $request,$id){
    	$update = array(
    		"status" => $request->update
    	);
    	KueOrder::where('id_order',$id)->update($update);

    	return back()->with('message','Status Berhasil diupdate');
    }
}
