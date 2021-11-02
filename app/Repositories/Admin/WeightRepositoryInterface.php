<?php
namespace App\Repositories\Admin;

interface WeightRepositoryInterface {
    public function store_or_update_weight($request, $id);
    public function multi_delete($request);
}
