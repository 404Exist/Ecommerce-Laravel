@php $name = App\Models\City::find($id)->first()->getTranslation('name', lang()); @endphp
<a data-toggle="modal" data-target="#multipleDelete" onclick="delete_admin_modal_ui({{$id}}, '{{$name}}', 'check_cities', 'deleteCitiesForm')"
class="btn btn-danger"> <i class="fa fa-trash"></i></a>
