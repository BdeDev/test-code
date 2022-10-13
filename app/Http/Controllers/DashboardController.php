<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LogActivity;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * dashboard page.
     *
     */
    public function dashboard()
    {
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months = User::select(DB::raw("month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $data = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($months as $index => $month) {
            $data[$month] = $users[$index];
        }
        $userdata = (array_slice($data, 1));
        return view('dashboard.dashboard', compact('userdata'));
    }

    //Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }


    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();

        return view('dashboard.activity.logActivity', compact('logs'));
    }



    //Files section
    public function Showfiles()
    {
        return view('dashboard.files.files');
    }
    //fetch Notification
    public function Notification()
    {
        $notify = Notification::all();
        return view('dashboard.notification.notifications', compact('notify'));
    }

    //Delete notification
    public function deletenotification($id)
    {
        try {
            $delete = Notification::where('id', $id)->first();
            if (!empty($delete)) {
                $delete->delete();
                return redirect('notifications');
            } else {
                return redirect()->back()->with('data not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
