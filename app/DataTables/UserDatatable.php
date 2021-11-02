<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'admin.accounts.users.btn.edit')
            ->addColumn('deletes', 'admin.accounts.users.btn.delete')
            ->addColumn('checkbox', 'admin.accounts.users.btn.checkbox')
            ->addColumn('level', 'admin.accounts.users.btn.level')
            ->rawColumns(['edit', 'deletes', 'checkbox', 'level']);
    }

    public function query()
    {
        return User::query()->where(function($query){
            return request()->has('level') ? $query->where('level', request()->level) : '';
        });
    }

    public static function lang()
    {
        return [
            'sProcessing' => __('admin.sProcessing'),
            'sLengthMenu' => __('admin.sLengthMenu'),
            'sZeroRecords' => __('admin.sZeroRecords'),
            'sEmptyTable' => __('admin.sEmptyTable'),
            'sInfo' => __('admin.sInfo'),
            'sInfoEmpty' => __('admin.sInfoEmpty'),
            'sInfoFiltered' => __('admin.sInfoFiltered'),
            'sInfoPostFix' => __('admin.sInfoPostFix'),
            'sSearch' => __('admin.sSearch'),
            'sUrl' => __('admin.sUrl'),
            'sInfoThousands' => __('admin.sInfoThousands'),
            'oPaginate' => [
                'sFirst' => __('admin.sFirst'),
                'sLast' => __('admin.sLast'),
                'sNext' => __('admin.sNext'),
                'sPrevious' => __('admin.sPrevious'),
            ],
            'oAria' => [
                'sSortAccendig' => __('admin.sSortAccendig'),
                'sSortDeccendig' => __('admin.sSortDeccendig'),
            ],
        ];
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('userdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make()
                            ->attr(['onClick' => 'window.location.href = "/admin/accounts/users/create"'])
                            ->className('btn btn-info')
                            ->text('<i class="fa fa-plus"></i> Create User'),
                        Button::make()
                            ->attr(['data-toggle'=>'modal', 'data-target'=>'#multipleDelete', 'onClick' => 'delete_admin_modal_ui()'])
                            ->className('btn btn-danger delAdminsBtn')
                            ->text('<i class="fa fa-trash"></i> Delete Selected'),
                        Button::make('csv')
                            ->className('btn btn-primary')
                            ->text('<i class="fa fa-file"></i> Export CSV'),
                        Button::make('excel')
                            ->className('btn btn-success')
                            ->text('<i class="fa fa-file"></i> Export Excel'),
                        Button::make('print')
                            ->className('btn btn-default')
                            ->text('<i class="fa fa-print"></i> Print'),
                        Button::make('reload')
                            ->className('btn btn-secondary')
                            ->text('<i class="fas fa-sync-alt"></i>')
                    )
                    ->parameters([
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All Record']],
                        'initComplete' => 'function () {
                            this.api().columns([1,2,3,4]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                .on("keyup", function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }',
                        'language' => self::lang()
                    ]);
                    // ->orderBy(1)
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('level')
                ->title('Level'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('edit')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('deletes')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('checkbox')
                ->orderable(false)
                ->title('<input type="checkbox" class="checkall" onClick="toggleCheckAll(this, \'check_admins\')"/>')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
