<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use Session;
use Mail;

class userLoginController extends Controller
{
   public function index(){
   	return view('user.login');
   }

   public function login(Request $request){
   	$find = User::where('username',$request->username)->first();
   	if(!empty($find->username)){
   		if(Hash::check($request->password,$find->password)){
   			Session::put('user',true);
   			Session::put('username',$find->username);
   			Session::put('id',$find->id_user);

   			return redirect(route('user.home'));
   		}else{
   			return back()->with('alert','Email atau password salah!');
   		}
   	}else{
   		return back()->with('alert','Email atau password salah!!');
   	}
   }

   public function forgot(){
   	return view('user.forgot');
   }

   public function register(){
   	return view('user.register');
   }

   public function userRegister(Request $request){
		date_default_timezone_set("Asia/jakarta");
		$date = Date('Y-m-d H:m:s');
	   	$find = User::where('username',$request->username)->first();
	   	if(empty($find->username)){
	   		$new = new User;
	   		$new->username = $request->username;
	   		$new->password = Hash::make($request->password);
	   		$new->nama = $request->nama;
	   		$new->alamat = $request->alamat;
	   		$new->kota = $request->kota;
	   		$new->provinsi = $request->provinsi;
	   		$new->kode_pos = $request->kode_pos;
	   		$new->no_tlp = $request->no_tlp;
	   		$new->created_at = $date;
	   		$new->updated_at = $date;
	   		$new->save();

	   		return back()->with('message','Silahkan Login');
	   	}else{
	   		return back()->with('alert','Email sudah terdaftar');
	   	}
   }

   public function logout(){
   		Session::flush();
        return redirect(route('user.login'))->with('message','Logout Berhasil');
   }

   public function reset(Request $request){
   	$random = str_random(8);
   	$find = User::where('username',$request->username)->first();
   	if(!empty($find->username)){
            try{
                Mail::send('user.email', ['newpass' => $random], function ($message) use ($request)
                {

                    $message->subject("Password Baru - Fathyia's Cake");
                    $message->to($request->username);
                });
                $update = array(
            		'password' => Hash::make($random)
            	);
            	User::where('username',$request->username)->update($update);
                return back()->with('message','Email sudah dikirim');
            }catch(Exception $e){
                return back()->with('alert','Terjadi kesalahan');
            }
    }else{
    	return back()->with('alert','Email tidak terdaftar');
    }
   }

   public function passwordChange(Request $request){
    $find = User::where('username',Session::get('username'))->first();
    if(strlen($request->new)>=8){
      if(Hash::check($request->old,$find->password)){
        if($request->new==$request->new2){
          $update = array(
            "password" => Hash::make($request->new)
          );
          User::where('id_user',$find->id_user)->update($update);
          return back()->with('status','Password Berhasil diubah');
        }else{
          return back()->with('status','Password baru dan password konfirmasi harus sama');
        }
      }else{
        return back()->with('status','Password lama salah');
      }
    }else{
      return back()->with('status','Password Minimal 8 Karakter');
    }
   }

   public function profile(){
    $data['user'] = User::where('id_user',Session::get('id'))->first();
    return view('user.profile',$data);
   }

   public function updateProfile(Request $request){
    $find = User::where('id_user',Session::get('id'))->first();
    $update = array(
      "nama" => $request->nama,
      "username" => $request->username,
      "no_tlp" => $request->no_tlp,
      "alamat" => $request->alamat,
      "kota" => $request->kota,
      "kode_pos" => $request->kode_pos
    );

    User::where('id_user',$find->id_user)->update($update);
    return back()->with('status','Profile Berhasil diupdate');
   }

}
