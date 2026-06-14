<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Contact;
use App\Http\Controllers\Controller;

/**
 * DashboardController
 * @author CK
 */
class AdminDashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @return void
     * @author CK
     */
    public function dashboard()
    {
        $userCount = User::role(USER_ROLE, 'web')->whereNotNull('password')->count();
        $enquiryCount = Contact::count();
        return view('admin.dashboard', compact('userCount', 'enquiryCount'));
    }
}
