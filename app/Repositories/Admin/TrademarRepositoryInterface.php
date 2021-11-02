<?php
namespace App\Repositories\Admin;

interface TrademarRepositoryInterface {
    public function store_or_update_trademark($request, $id);
    public function multi_delete($request);
}
