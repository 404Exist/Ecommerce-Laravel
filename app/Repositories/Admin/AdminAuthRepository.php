<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AdminAuthRepository implements AdminAuthRepositoryInterface{
    public function do_login($request)
    {
        $remmberme = $request->rememberme == 1 ? true : false;
        if (admin_auth()->attempt(['email' => $request->email, 'password' => $request->password], $remmberme)) {
            return redirect($request->intended);
        }
        return redirect(admin_url('login'))->withErrors(__('admin.invalid credentials'));
    }

    public function do_forgot_password($request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!empty($admin)) {
            $token = Str::random(60);
            DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin, 'token'=>$token]));
            return back()->with(['success' => __('admin.reset link sent')]);
        }
        return back();
    }

    public function do_reset_password($request, $token)
    {
        $request->validated();
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            Admin::where('email', $check_token->email)->update([
                'password' => Hash::make($request->password),
            ]);
            DB::table('password_resets')->where('email', $check_token->email)->delete();
            admin_auth()->attempt(['email' => $check_token->email, 'password' => $request->password]);
            return redirect(admin_url());
        }
        return redirect(admin_url('forgot-password'));
    }
}
