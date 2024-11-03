<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Madminaccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class Cadmininfo extends Controller
{
    public function showAllAdmin()
    {
        // Get the total number of admin accounts
        $totalStaff = Madminaccount::count();

        // For current staff, if you have a way to define it, adjust this query accordingly.
        // For now, we'll just count all accounts.
        $currentStaff = $totalStaff; // This can be adjusted based on your logic

        return view('admin.admin_dashboard', compact('totalStaff', 'currentStaff'));
    }

}
