<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use DataTables;
use Lang;
use Image;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        return view('_admin.users.index', ['role' => $role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role)
    {
        return view('_admin.users.create', ['role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->replace(array_filter($request->all()));

        $request->validate([
          'name' => 'required',
          'username' => 'required|unique:users|max:12|alpha_num',
          'email' => 'email|unique:users',
          'password' => 'min:8|required',
          'phone' => 'numeric',
          'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);

        $store = DB::table('users')->insert($requestData);
        $id = DB::getPdo()->lastInsertId();

        if ($request->has('profile_image')) {
          $image = $request->file('profile_image');
          $name = time().'_'.$image->getClientOriginalName();

          $img = Image::make($image->getRealPath());
          $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
          })->save(public_path('/images/users/300/').$name);
          $img->fit(50, 50)->save(public_path('/images/users/50/').$name);
          $image->move('images/users/full', $name);

          User::where('id', $id)->update(['profile_image' => $name]);
        }

        return response()->json([
          'id' => $id,
          'messages' => Lang::get('validation.custom.user.created'),
          'status' => 200]
        );
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

    /**
    * Datatables server side.
    */
    public function usersDt($role){
      return DataTables::of(User::where('role', '=', $role))->make(true);
    }
}
