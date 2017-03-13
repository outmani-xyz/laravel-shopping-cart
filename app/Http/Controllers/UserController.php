<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;
class UserController extends Controller {

    public function getSignup() {
        return view('user.signup');
    }

    public function postSignup(Request $request) {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:5'
        ]);
        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();

        if (Session::has('oldUrl')) {
            $oldurl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldurl);
        }
        return redirect()->route('product.index');
    }

    public function getSignin() {
        return view('user.signin');
    }

    public function postSignin(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:5'
        ]);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if (Session::has('oldUrl')) {
                $oldurl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldurl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile() {
        $orders=Auth::user()->orders;
        $orders->transform(function($order,$key){
            $order->cart= unserialize($order->cart);
            return $order;
        });
        return view('user.profile',['orders'=>$orders]);
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('product.index');
    }

}
