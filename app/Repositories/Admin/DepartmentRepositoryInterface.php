<?php
namespace App\Repositories\Admin;

interface DepartmentRepositoryInterface {
    public function store_or_update_department($request, $id);
    public function multi_delete($request);
}
