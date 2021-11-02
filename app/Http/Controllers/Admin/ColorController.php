<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ColorDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreColorRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Models\Color;
use App\Repositories\Admin\ColorRepositoryInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public $colorRepo;
    public function __construct(ColorRepositoryInterface $colorRepo)
    {
        $this->middleware('permission:Show Colors', ['only' => ['index']]);
        $this->middleware('permission:Add Colors', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Colors', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Colors', ['only' => ['destroy']]);
        $this->colorRepo = $colorRepo;
    }
    public function index(ColorDatatable $admin)
    {
        return $admin->render('admin.colors.index', ['title' => 'Colors']);
    }

    public function create()
    {
        return view('admin.colors.create', ['title' => 'Add Color']);
    }

    public function store(StoreColorRequest $request)
    {
        $request->validated();
        return $this->colorRepo->store_or_update_color($request, '');
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        $title = 'Edit Color';
        return view('admin.colors.edit', compact('color', 'title'));
    }

    public function update(UpdateColorRequest $request, $id)
    {
        return $this->colorRepo->store_or_update_color($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->colorRepo->multi_delete($request);
    }
}
