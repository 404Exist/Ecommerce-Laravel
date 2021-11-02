<?php
namespace App\Repositories\Admin;

interface ManufactRepositoryInterface {
    public function store_or_update_manufacturer($request, $id);
    public function multi_delete($request);
}
