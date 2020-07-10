<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;
use App\Model\User;
use Session;

class adminController extends Controller
{
    public function changePassword(Request $request){
    	$old = Admin::where('id_admin',Session::get('id'))->first();
    	if(!Hash::check($request->oldpw,$old->password)){
			return back()->with('alert','Password lama salah');
    	}
    	if($request->pw!=$request->pw2){
    		return back()->with('alert','Password Baru dan Konfirmasi tidak sama');
    	}
    	if(strlen($request->pw)<8){
			return back()->with('alert','Password minimal 8 karakter');	
		}
		$update = array('password' => Hash::make($request->pw) );
		Admin::where('id_admin',Session::get('id'))->update($update);
		return back()->with('message','Password Berhasil Diubah');
    }
    public function logout(){
        Session::flush();
        return redirect(route('login'))->with('message','Logout Berhasil');
    }

    public function adminList(){
        $data['table'] = true;
        $data['admin'] = Admin::all();
        return view('admin.adminList',$data);
    }

    public function adminDelete($id){
        Admin::where('id_admin',$id)->delete();
        return back()->with('message','Admin Berhasil dihapus');
    }   

    public function adminAdd(Request $request){

        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');

        $check = Admin::where('username',$request->username)->first();
        if(empty($check->username)){
            $add = new Admin;
            $add->nama = $request->nama;
            $add->username = $request->username;
            $add->password = Hash::make('N3wAdmin');
            $add->updated_at = $date;
            $add->created_at = $date;
            $add->save();

            return back()->with('message',"Admin Berhasil ditambah, Login dengan username $request->username dan password N3wAdmin");
        }else{
            return back()->with('alert',"Email sudah dipakai");
        }
    }

    public function adminEdit(Request $request,$id){
        $update = array(
            "nama" => $request->nama,
            "username" =>$request->username
        );

        Admin::where('id_admin',$id)->update($update);

        return back()->with('message',"Admin Berhasil diedit");
    }

    public function adminReset(Request $request,$id){
        $update = array(
            "password" => Hash::make('N3wPassAdmin')
        );

        Admin::where('id_admin',$id)->update($update);

        return back()->with('message',"Password Berhasil direset, silahkan login dengan N3wPassAdmin");
    }

    public function userList(){
        $data['table'] = true;
        $data['user'] = User::all();
        return view('admin.userList',$data);
    }

    public function userDelete($id){
        User::where('id_user',$id)->delete();
        return back()->with('message','User Berhasil dihapus');
    }   

    public function userAdd(Request $request){

        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');
        $check = User::where('username',$request->username)->first();
        if(empty($check->username)){
            $add = new User;
            $add->nama = $request->nama;
            $add->username = $request->username;
            $add->password = Hash::make('N3wUser');
            $add->alamat = $request->alamat;
            $add->kota = $request->kota;
            $add->provinsi = $request->provinsi;
            $add->kode_pos = $request->kode_pos;
            $add->no_tlp = $request->no_tlp;
            $add->updated_at = $date;
            $add->created_at = $date;
            $add->save();

            return back()->with('message',"User Berhasil ditambah, Login dengan username $request->username dan password N3wUser");
        }else{
            return back()->with('alert',"Email sudah dipakai");
        }
    }

    public function userEdit(Request $request,$id){
        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');
        $update = array(
            "nama" => $request->nama,
            "username" => $request->username,
            "alamat" => $request->alamat,
            "kota" => $request->kota,
            "provinsi" => $request->provinsi,
            "kode_pos" => $request->kode_pos,
            "no_tlp" => $request->no_tlp,
            "updated_at" => $date
        );

        User::where('id_user',$id)->update($update);

        return back()->with('message',"User Berhasil diedit");
    }

    public function userReset(Request $request,$id){
        $update = array(
            "password" => Hash::make('N3wPassUser')
        );

        User::where('id_user',$id)->update($update);

        return back()->with('message',"Password Berhasil direset, silahkan login dengan N3wPassUser");
    }
}
