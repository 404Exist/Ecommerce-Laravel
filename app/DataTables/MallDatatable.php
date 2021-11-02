<?php

namespace App\DataTables;

use App\Models\Mall;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MallDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function(Mall $mall) { return $mall->getTranslation('name', lang()); })
            ->editColumn('email', function(Mall $mall) { return '<a href="mailto:'.$mall->email.'" /><i class="fas fa-envelope-open-text fa-2x"></i></a>'; })
            ->editColumn('facebook', function(Mall $mall) { return '<a target="_blank" href="'.$mall->facebook.'" /><i class="fab fa-facebook-square fa-2x"></i></a>'; })
            ->editColumn('twitter', function(Mall $mall) { return '<a target="_blank" href="'.$mall->twitter.'" /><i class="fab fa-twitter-square fa-2x"></i></a>'; })
            ->editColumn('website', function(Mall $mall) { return '<a target="_blank" href="'.$mall->website.'" /><i class="fas fa-globe fa-2x"></i></a>'; })
            ->editColumn('logo', function(Mall $mall) {return !empty($mall->logo) ? "<img src='". asset('storage/'.$mall->logo)."' style='width: 30px;height: 30px;' />" : '';})
            ->editColumn('deletes', function(Mall $mall){$id = $mall->id;$name = $mall->getTranslation('name', lang());
                return '
                    <a data-toggle="modal" data-target="#multipleDelete"
                    onclick="delete_admin_modal_ui('.$id.', \''.$name.'\', \'check_malls\', \'deleteMallsForm\')"
                    class="btn btn-danger"> <i class="fa fa-trash"></i></a>';})
            ->addColumn('edit', 'admin.malls.btn.edit')
            ->addColumn('checkbox', 'admin.malls.btn.checkbox')
            ->rawColumns(['edit', 'deletes', 'checkbox', 'logo', 'email', 'facebook', 'twitter', 'website']);
    }

    public function query()
    {
        return Mall::query();
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
                    ->setTableId('malldatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make()
                            ->attr(['onClick' => 'window.location.href = "/admin/malls/create"'])
                            ->className('btn btn-info')
                            ->text('<i class="fa fa-plus"></i> Add mall'),
                        Button::make()
                            ->attr(['data-toggle'=>'modal', 'data-target'=>'#multipleDelete', 'onClick' => 'delete_admin_modal_ui("", "", "check_malls", "deleteMallsForm")'])
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
                            this.api().columns([0,1,2]).every(function () {
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
            Column::make('mobile'),
            Column::make('contact_name'),
            Column::make('email'),
            Column::make('facebook'),
            Column::make('twitter'),
            Column::make('website'),
            // Column::make('logo'),
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
                ->title('<input type="checkbox" class="checkall" onClick="toggleCheckAll(this, \'check_malls\')"/>')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Mall_' . date('YmdHis');
    }
}
