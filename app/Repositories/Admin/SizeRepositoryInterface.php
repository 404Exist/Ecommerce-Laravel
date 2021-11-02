<?php
namespace App\Repositories\Admin;

interface SizeRepositoryInterface {
    public function store_or_update_size($request, $id);
    public function multi_delete($request);
}
