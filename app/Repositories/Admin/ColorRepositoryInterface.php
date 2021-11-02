<?php
namespace App\Repositories\Admin;

interface ColorRepositoryInterface {
    public function store_or_update_color($request, $id);
    public function multi_delete($request);
}
