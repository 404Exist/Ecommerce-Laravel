<?php
namespace App\Repositories\Admin;

interface ShippingRepositoryInterface {
    public function store_or_update_shipping($request, $id);
    public function multi_delete($request);
}
