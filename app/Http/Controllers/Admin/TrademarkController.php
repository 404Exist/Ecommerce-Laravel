<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TrademarkDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrademarkRequest;
use App\Http\Requests\Admin\UpdateTrademarkRequest;
use App\Models\Trademark;
use App\Repositories\Admin\TrademarRepositoryInterface;
use Illuminate\Http\Request;

class TrademarkController extends Controller
{
    public $trademarkRepo;
    public function __construct(TrademarRepositoryInterface $trademarkRepo)
    {
        $this->middleware('permission:Show Trademarks', ['only' => ['index']]);
        $this->middleware('permission:Add Trademarks', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Trademarks', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Trademarks', ['only' => ['destroy']]);
        $this->trademarkRepo = $trademarkRepo;
    }
    public function index(TrademarkDatatable $admin)
    {
        return $admin->render('admin.trademarks.index', ['title' => 'Trademarks']);
    }

    public function create()
    {
        return view('admin.trademarks.create', ['title' => 'Add Trademark']);
    }

    public function store(StoreTrademarkRequest $request)
    {
        $request->validated();
        return $this->trademarkRepo->store_or_update_trademark($request, '');
    }

    public function edit($id)
    {
        $trademark = Trademark::find($id);
        $title = 'Edit Trademark';
        return view('admin.trademarks.edit', compact('trademark', 'title'));
    }

    public function update(UpdateTrademarkRequest $request, $id)
    {
        return $this->trademarkRepo->store_or_update_trademark($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->trademarkRepo->multi_delete($request);
    }
}
