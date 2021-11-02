<?php
namespace App\Repositories\Admin;

interface UserRepositoryInterface {
    public function store_user($request);
    public function update_user($request, $id);
    public function multi_delete($request);
}
