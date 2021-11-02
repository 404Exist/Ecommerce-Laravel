<?php
namespace App\Repositories\Admin;

interface AdminRepositoryInterface {
    public function store_admin($request);
    public function update_admin($request, $id);
    public function multi_delete($request);
}
