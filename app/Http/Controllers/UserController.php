<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function users()
    {
        $count = User::where('role', '!=', User::ROLE_ADMIN)->paginate(8);
        return view('dashboard.user-management.users', compact('count'));
    }
    public function show($id)
    {
        $show = User::where('id', $id)->first();
       
        return view('dashboard.user-management.show', compact('show'));
    }


    /*
     * Delete
    */ 
    public function delete($id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!empty($user)) {
                $user->delete();
                return redirect('/dashboard/users');
            } else {
                return redirect()->back()->with('error',"user not found");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    /*
     * Open Form 
    */
    public function add()
    {
        return view('dashboard.user-management.adduser');
    }

    /*
     * Store Data
    */
    public function addUser(Request $req)
    {
        try {
            $validator = validator($req->all(),
                [
                'name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
                'role' => 'required|integer',
                'image'  => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->role = $req->input('role');
            $user->password = Hash::make($req->password);
            
            if ($req->hasfile('image')) {
                $file = $req->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $user->image = $filename;
            }
         
            $user->save();
            if ($user->id != null) {
                Notification::create([
                    'title' => $user->name . ' Added',

                    'description' => 'A new User has been added',

                    'model_id' => $user->id,
                    'model_type' => 'User',
                    'to_user_id' => User::ROLE_ADMIN,
                    'created_by_id' => $user->id,
                ]);
                if ($user) {
                    return redirect('/dashboard/users')->with('success', "Saved successfully");
                } else {
                    return redirect()->back()->with('error', "unexpected error occurred,Couldn't be saved");
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    /*
     * Edit
    */ 

    public function edit($id)
    {
        $GetData = User::find($id);
        return view('dashboard.user-management.update', compact('GetData'));
    }
    /*
     * Update
    */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
           
            $user->name = $request->input('name');
            $user->dob = $request->input('dob');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads', $filename);
                $user->image = $filename;
            }
          
            if (
                $user->update()
            ) {
                return redirect('/dashboard/users')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Error Occurred,Data Couldn't be Updated.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
