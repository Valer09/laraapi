<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->json(
           [
               'data' => User::get(),
               'success' => true
           ]) ;
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
        try{
            $user= new User();

            $postData= $request->except('id', '_method');

            $postData['password'] = Hash::make($postData['password'] ?? 'password');

            $user -> fill($postData);
            $success = $user -> save();

            $data = $user;
        } catch (\exception $e) {
            $success=false;
            $message=$e->getMessage();
        }
        return compact('data','message','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            return response()->json( ['data'=> User::findOrFail($id)]);
        } catch (\exception $e){
            return response() -> json(
                [
                    'data' => [],
                    'message' => $e->getMessage()

                ]);
        }

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
        try{
            $user= User::findOrFail($id);
            $postData= $request->except('id', '_method');
            $postData['password'] = Hash::make('ciaociao');
            $success = $user -> update($postData);
            $data = $user;
        } catch (\exception $e) {
            $success=false;
            $message=$e->getMessage();
        }
        return compact('data','message','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];
        $message = 'User deleted';
        try{
            $user= User::findOrFail($id);
            $success = $user -> delete();
        } catch (\exception $e) {
            $success=false;
            $message= 'User not found ';
        }
        return compact('data','message','success');
    }
}
