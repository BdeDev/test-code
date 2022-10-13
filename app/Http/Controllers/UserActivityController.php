<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LogActivity;
use App\Models\User;

class UserActivityController extends Controller
{
    //user activity
    public function useractivity(){
        return view('dashboard.activity.useractivity');
    }

    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('dashboard.activity.logActivity',compact('logs'));
    }
    //user table delete query
    public function delete($id)
    {
        try{
            $delete=LogActivity::where('id',$id)->first();
            if(!empty($delete)){
                $delete->delete();
                return redirect('logActivity');
            } else {
                return redirect()->back()->with('data not found');
            }
        }catch (\Exception $e) {     
            return redirect()->back()->with($e->getMessage());
        }


    }
    //Total count of user activity
    public function users() 
    {
        $count = User::where('role', '!=', User::ROLE_ADMIN)->get();
        return view('dashboard.user-management.users', compact('count'));
    }
}