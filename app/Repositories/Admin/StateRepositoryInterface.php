<?php
namespace App\Repositories\Admin;

interface StateRepositoryInterface{
    public function store_or_update_city($request, $id);
    public function multi_delete($request);
}
