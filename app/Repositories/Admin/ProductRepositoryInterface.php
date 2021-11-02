<?php
namespace App\Repositories\Admin;

interface ProductRepositoryInterface {
    public function store_or_update_product($request, $id);
    public function multi_delete($request);
    public function product_clone($request);
}
