<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userHomeController extends Controller
{
    public function index(Request $request){
    	return view('user.home');
    }
    public function productIndex(Request $request){
    	return view('user.productPage');
    }
    public function checkoutIndex(Request $request){
    	return view('user.checkout');
    }
}
