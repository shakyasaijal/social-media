<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $roles;

    public function __construct()
    {
        $this->roles = Role::get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();
        return view('admin.users.index', [
            'users' => $users
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'roles' => $this->roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'nullable|min:8|max:32|confirmed',
            'address' => 'nullable|max:200',
            'phone' => 'nullable|max:50',
            'avatar' => 'nullable|mimes:jpeg,jpg,gif,png,svg,bmp|max:2048',
            'roles' => 'required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        //upload new file
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar');
            $extension = $photo->getClientOriginalExtension();
            $destination = 'uploads/users';
            $photo_name = $destination . '/' . str_slug($request->input('name')) . '.' . $extension;
            $photo->move($destination, $photo_name);
            $user->avatar = $photo_name;
        }
        $user->save();

        $user->roles()->attach(
            $request->input('roles')
        );


        return redirect()->back()->with('success', 'New user created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $this->roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
            'password' => 'nullable|min:8|max:32|confirmed',
            'address' => 'nullable|max:200',
            'phone' => 'nullable|max:50',
            'avatar' => 'nullable|mimes:jpeg,jpg,gif,png,svg,bmp|max:2048',
            'roles' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        //upload new file
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar');
            $extension = $photo->getClientOriginalExtension();
            $destination = 'uploads/users';
            $photo_name = $destination . '/' . md5(time()) . '.' . $extension;

            if ($user->avatar && app('files')->exists($user->avatar)) {
                app('files')->delete($user->avatar);
                //unlink($user->avatar);
            }
            $photo->move($destination, $photo_name);
            $user->avatar = $photo_name;
        }

        $user->roles()->sync(
            $request->input('roles')
        );

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        if ($user->avatar && app('files')->exists($user->avatar)) {
            app('files')->delete($user->avatar);
            //unlink($user->avatar);
        }
        if ($user->delete()) {
            return redirect()->back()->with('success', 'User deleted successfully');
        }
    }

    public function profile($auth_user_name = null)
    {
        $data = [];
        $user = auth()->user();
        $roles = $this->roles;
        $data['user'] = $user;
        $data['roles'] = $roles;
        return view('admin.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'password' => 'nullable|min:8|max:32|confirmed',
            'address' => 'nullable|max:200',
            'phone' => 'nullable|max:50',
            'avatar' => 'nullable|mimes:jpeg,jpg,gif,png,svg,bmp|max:2048',
            'roles' => 'required'
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        //upload new file
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar');
            $extension = $photo->getClientOriginalExtension();
            $destination = 'uploads/users';
            $photo_name = $destination . '/' . md5(time()) . '.' . $extension;

            if ($user->avatar && app('files')->exists($user->avatar)) {
                app('files')->delete($user->avatar);
                //unlink($user->avatar);
            }
            $photo->move($destination, $photo_name);
            $user->avatar = $photo_name;
        }

        $user->roles()->sync(
            $request->input('roles')
        );

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }
}
