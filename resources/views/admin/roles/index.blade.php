@extends('admin.index')
@push('css')

@endpush
@section('title')
    {{ $title }}
@endsection
@section('content')

<div class="container-fluid">
<div class="card">
    <div class="card-header">
        @can('Add Role')
            <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">Add</a>
        @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mg-b-0 text-md-nowrap table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Process</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('Show Role')
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('roles.show', $role->id) }}">عرض</a>
                                @endcan

                                @can('Edit Role')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                @endcan

                                @if ($role->name !== 'owner')
                                    @can('Delete Role')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                        $role->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


</div><!-- /.container-fluid -->
@endsection
@push('js')

@endpush
