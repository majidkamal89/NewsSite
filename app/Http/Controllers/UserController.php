<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function __construct(){
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|string|same:password'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }
        $user = $this->user->register($request);
        if($user['status'] == 'success'){
            //$this->user->sendEmail($request->email, 'Your Account Created Successfully.', 'User Registration');
            session()->flash('success', 'Account Created Successfully!');
            return redirect()->to('/')->with('success', 'Account Created Successfully!');
        } else {
            session()->flash('failure', 'Error creating account! ' . $user['message']);
            return redirect()->back()->with('failure', 'Error creating account! ' . $user['message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
