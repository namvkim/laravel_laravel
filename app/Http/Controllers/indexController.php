<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Slide;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        $slides = Slide::get();
        return view('index', ['products' => $products, 'slides' => $slides]);
    }
    public function postSignup(Request $request)
    {
        $user = new Users();
        $user->full_name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();

        return redirect('/login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $pass = $request->password;

        $user = Users::whereEmail($email)->first();
        if ($user != null) {
            if (Hash::check($pass, $user->password)) {
                $formData = [
                    'acceptoken' => true,
                    'user' => $user,
                ];
                return view('login', ['formData' => $formData]);
            }
        }
        $formData = [
            'acceptoken' => false,
        ];
        return view('login', ['formData' => $formData]);
    }

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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
