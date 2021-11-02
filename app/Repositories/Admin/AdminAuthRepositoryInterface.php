<?php
namespace App\Repositories\Admin;

interface AdminAuthRepositoryInterface {
    public function do_login($request);
    public function do_forgot_password($request);
    public function do_reset_password($request, $token);
}
