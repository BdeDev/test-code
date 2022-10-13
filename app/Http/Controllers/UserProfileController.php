<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //Opens view
    public function profile()
    {
        return view('dashboard.myprofile.personaldetails');
    }

    //Shows user Info
    public function show()
    {

        $userinfo = User::find(Auth::user()->id);
        return view('dashboard.myprofile.personaldetails', compact('userinfo'));
    }

    //Getting User Id
    public function edit($id)
    {
        $GetUser = User::find($id);
        return view('dashboard.myprofile.personaldetailsupdate', compact('GetUser'));
    }
    //Updating User Info
    public function update(Request $request, $id)
    {
        try {
            $update = User::find($id);
            $update->name = $request->input('name');
            $update->dob = $request->input('dob');
            $update->address = $request->input('address');
            $update->phone = $request->input('phone');
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move('public/uploads/', $filename);
                $update->image = $filename;
            }
            if (
                $update->update()
            ) {
                return redirect('/dashboard/myprofile')->with('success', "Data has been Updated Successfully");
            } else {
                return redirect()->back()->with('error', "Data Couldn't be updated");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
