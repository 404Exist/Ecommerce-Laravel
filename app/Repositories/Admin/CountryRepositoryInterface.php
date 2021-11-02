<?php
namespace App\Repositories\Admin;

interface CountryRepositoryInterface {
    public function store_or_update_country($request, $id);
    public function multi_delete($request);
}
