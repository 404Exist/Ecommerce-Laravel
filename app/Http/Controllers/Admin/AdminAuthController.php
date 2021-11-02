<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetpasswordRequest;
use App\Repositories\Admin\AdminAuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public $adminAuthRepo;
    public function __construct(AdminAuthRepositoryInterface $adminAuthRepo)
    {
        $this->adminAuthRepo = $adminAuthRepo;
    }

    // Forms Actions
    public function loginAction(Request $request)
    {
        return $this->adminAuthRepo->do_login($request);
    }

    public function forgotPasswordAction(Request $request)
    {
        return $this->adminAuthRepo->do_forgot_password($request);
    }

    public function reset_passwordAction(ResetpasswordRequest $request, $token)
    {
        return $this->adminAuthRepo->do_reset_password($request, $token);
    }

    public function logout()
    {
        admin_auth()->logout();
        return redirect(admin_url('login'));
    }


    // Views
    public function reset_password($token)
    {
        // where token = token && created_at > last two hours
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            return view('admin.reset-password', ['data' => $check_token]);
        }
        return redirect(admin_url('forgot-password'));
    }
    public function login()
    {
        return view('admin.login');
    }
    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }


}
