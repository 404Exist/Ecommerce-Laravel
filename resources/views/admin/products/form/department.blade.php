@php
    $dep_id = !isset($product) ? old('department_id') : $product->department_id;
@endphp
@push('css')
    <link rel="stylesheet" href="{{ url('assets/adminlte/jsTree/themes/default/style.css') }}" />
@endpush
<div id="department" class="container tab-pane fade"><br>
    <h3>Product Department</h3>
    @if (load_department() === '[]')
        There are no departments
    @else
        <div id="department_btns"></div>
        <div id="jstree"></div>
        {!! Form::hidden('department_id', $dep_id) !!}
    @endif
</div>

@push('js')
    <script src="{{ url('assets/adminlte/jsTree/jstree.js') }}"></script>
    <script src="{{ url('assets/adminlte/jsTree/jstree.wholerow.js') }}"></script>
    <script src="{{ url('assets/adminlte/jsTree/jstree.checkbox.js') }}"></script>
    <script>
        $('#jstree').jstree({
            "core" : {
                'data' : {!! load_department($dep_id) !!},
                'themes' : {
                    'variant' : 'large'
                }
            },
            "plugins" : [ "wholerow" ],
        });
        $('#jstree').on("changed.jstree", function (e, data) {
            let i, j, r = [];
            for (i=0,j=data.selected.length; i< j; i++) {
                r.push(data.selected[i]);
            }
            let id = r.join(', ');
            if (id != '') {
                $('input[name=department_id]').val(id);
                ajax({
                    type: 'POST',
                    url: "{{ admin_url('load-weight-size') }}",
                    @if (isset($product))
                        data: {department_id: id, product_id: {{$product->id}} },
                    @else
                        data: {department_id: id},
                    @endif
                    success: function (data) {
                        ajaxResponse.innerHTML = data.responseText;
                        shipping_info.classList.remove("d-none");
                        title.classList.add('d-none');
                    }
                });
            }
        });
    </script>
@endpush
