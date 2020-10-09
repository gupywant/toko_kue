<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\JenisKue;
use App\Model\User;
use App\Model\Kue;
use App\Model\KueOrder;
use App\Model\OrderDetail;
use App\Model\KueGambar;
use App\Model\KueKeranjang;
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
        $data['kueSejenis'] = Kue::selectRaw('kue.*,(select gambar from kue_gambar a where id_gambar = (select min(id_gambar) from kue_gambar where id_kue = kue.id_kue )) as gambar,jenis_kue.nama as nama_jenis')->leftJoin('jenis_kue','jenis_kue.id_jenis','=','kue.id_jenis')->where('kue.id_jenis',$kue->id_jenis)->limit(4)->get();
    	return view('user.productPage',$data);
    }

    public function checkoutIndex(Request $request,$id){
        $find = User::where('username',Session::get('username'))->first();
        $jumlah = $request->jumlah;
        $kue = Kue::where('id_kue',$id)->first();
        $keranjang = KueKeranjang::where('id_kue',$id)->first();
        if(!empty($keranjang)){
            $data = array(
                "jumlah" => $keranjang->jumlah+$jumlah
            );
            KueKeranjang::where([['id_kue',$id],['id_user',$find->id_user]])->update($data);
        }else{
            $new = new KueKeranjang;
            $new->id_kue = $id;
            $new->id_user = $find->id_user;
            $new->jumlah = $jumlah;
            $new->waktu = $kue->waktu_po;
            $new->save();
        }
        //$data['kue'] = Kue::where('id_kue',$id)->first();

        return back()->with('status', 'Berhasil tambah keranjang');
    	//return view('user.checkout',$data);
    }

    public function checkoutDetail(Request $request){
        $user = User::where('username',Session::get('username'))->first();
        $data['keranjang'] = KueKeranjang::leftJoin('kue','kue.id_kue','=','kue_keranjang.id_kue')->where('kue_keranjang.id_user',$user->id_user)->get();
        $data['user'] = $user;
        return view('user.checkout',$data);
    }

    public function checkoutDelete($id){
        $user = User::where('username',Session::get('username'))->first();
        $keranjang = KueKeranjang::where([['id_user',$user->id_user],['id_kue',$id]])->delete();

        return back()->with('status','Item berhasil dihapus dari keranjang');
    }

    public function checkoutProses(Request $request){
        $user = User::where('username',Session::get('username'))->first();
        $keranjang = KueKeranjang::selectRaw('max(waktu) as waktu, id_kue')->where('id_user',$user->id_user)->groupBy('id_kue')->first();
        $keranjangAll = KueKeranjang::where('id_user',$user->id_user)->get();
        $kode = str_pad(mt_rand(1,99999999),12,'0',STR_PAD_LEFT);

        $new = new KueOrder;
        $new->id_kue = $keranjang->id_kue;
        $new->id_user = $user->id_user;
        $new->kode = $kode;
        $new->status = 0;
        $new->waktu = $keranjang->waktu;
        $new->save();

        $jumlah = 0;
        $total = 0;

        foreach ($keranjangAll as $key => $value) {
            # code...
            $detail = new OrderDetail;
            $detail->id_order = $new->id_order;
            $detail->id_kue = $value->id_kue;
            $detail->jumlah = $value->jumlah;
            $detail->save();

            $kue = kue::where('id_kue',$value->id_kue)->first();

            $jumlah += $value->jumlah;
            $temp = $value->jumlah*$kue->harga;
            $total += $temp;
        }

        $data = array(
            "jumlah" => $jumlah,
            "total" => $total
        );

        KueOrder::where('id_order',$new->id_order)->update($data);

        KueKeranjang::where('id_user',$user->id_user)->delete();

        return redirect(route('user.orderUser'))->with('order',$kode);

    }

    public function checkoutIndexGet(){
        return redirect(route('user.home'));
    }

    public function orderUser(Request $request){
        $find = User::where('username',Session::get('username'))->first();
        $data['inorder'] = KueOrder::selectRaw('*')->where([['kue_order.id_user',$find->id_user],['status','<=',1]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['onproses'] = KueOrder::where([['kue_order.id_user',$find->id_user],['status','=',2]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['finish'] = KueOrder::where([['kue_order.id_user',$find->id_user],['status','=',3]])->leftJoin('kue','kue.id_kue','=','kue_order.id_kue')->orderBy('kue_order.created_at','desc')->get();
        $data['tabel'] = true;
        return view('user.order',$data);
    }

    public function orderDetail($id){
        $data['order'] = OrderDetail::selectRaw('*')->where('order_detail.id_order',$id)->leftJoin('kue','kue.id_kue','=','order_detail.id_kue')->get();
        return view('user.orderDetail',$data);
    }
}
