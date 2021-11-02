<?php

namespace App\DataTables;

use App\Models\Weight;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WeightDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function(Weight $weight) { return $weight->getTranslation('name', lang()); })
            ->editColumn('deletes', function(Weight $weight){$id = $weight->id;$name = $weight->getTranslation('name', lang());
                return '
                    <a data-toggle="modal" data-target="#multipleDelete"
                    onclick="delete_admin_modal_ui('.$id.', \''.$name.'\', \'check_weights\', \'deleteWeightsForm\')"
                    class="btn btn-danger"> <i class="fa fa-trash"></i></a>';})
            ->addColumn('edit', 'admin.weights.btn.edit')
            ->addColumn('checkbox', 'admin.weights.btn.checkbox')
            ->rawColumns(['edit', 'deletes', 'checkbox']);
    }

    public function query()
    {
        return Weight::query();
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
                    ->setTableId('weightdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make()
                            ->attr(['onClick' => 'window.location.href = "/admin/weights/create"'])
                            ->className('btn btn-info')
                            ->text('<i class="fa fa-plus"></i> Add Weight'),
                        Button::make()
                            ->attr(['data-toggle'=>'modal', 'data-target'=>'#multipleDelete', 'onClick' => 'delete_admin_modal_ui("", "", "check_weights", "deleteWeightsForm")'])
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
                            this.api().columns([0]).every(function () {
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
    }

    protected function getColumns()
    {
        return [
            Column::make('name'),
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
                ->title('<input type="checkbox" class="checkall" onClick="toggleCheckAll(this, \'check_weights\')"/>')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Weight_' . date('YmdHis');
    }
}
