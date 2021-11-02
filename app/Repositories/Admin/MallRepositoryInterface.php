<?php
namespace App\Repositories\Admin;

interface MallRepositoryInterface {
    public function store_or_update_mall($request, $id);
    public function multi_delete($request);
}
