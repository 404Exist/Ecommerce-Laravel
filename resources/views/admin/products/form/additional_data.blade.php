<div id="additional_data" class="container tab-pane fade"><br>
  <div id="multiple_inputs">
    @if (isset($product))
      @foreach ($product->other_data as $key => $data)
        <div class="row">
          <div class="col-md-5">
            {!! Form::label('input_key', 'Key') !!}
            {!! Form::text('input_key[]', $key, ['class' => 'form-control']) !!}
          </div>
          <div class="col-md-5">
            {!! Form::label('input_value', 'Value') !!}
            {!! Form::text('input_value[]', $data, ['class' => 'form-control']) !!}
          </div>
          <div class="col-md-2">
            <label>Delete</label><br>
            <a class="btn btn-danger" onclick="this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></a>
          </div>
        </div>
      @endforeach
    @else
      <div class="row">
        <div class="col-md-5">
          {!! Form::label('input_key', 'Key') !!}
          {!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-5">
          {!! Form::label('input_value', 'Value') !!}
          {!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-2">
          <label>Delete</label><br>
          <a class="btn btn-danger" onclick="this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></a>
        </div>
      </div>
    @endif
  </div>

  <br>
  <a class="btn btn-info" onclick="buildInputs()"><i class="fa fa-plus"></i></a>

</div>

@push('js')
  <script>
    function buildInputs() {
      var oldKeys = [],
        oldValues = [];
      multiple_inputs.children.forEach((child, index) => {
        oldKeys[index] = child.children[0].children[1].value;
        oldValues[index] = child.children[1].children[1].value;
      });
      let max_input = 10;
      if (multiple_inputs.children.length < max_input) {
        multiple_inputs.innerHTML += `
          <div class="row">
            <div class="col-md-5">
              {!! Form::label('input_key', 'Key') !!}
              {!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-5">
              {!! Form::label('input_value', 'Value') !!}
              {!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-2">
              <label>Delete</label><br>
              <a class="btn btn-danger" onclick="this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></a>
            </div>
          </div>
        `;
        multiple_inputs.children.forEach((child, index) => {
            if (child.children[0].children[1].value === '') child.children[0].children[1].value = oldKeys[index] === undefined ? '' : oldKeys[index];
            if (child.children[1].children[1].value === '') child.children[1].children[1].value = oldValues[index] === undefined ? '' : oldValues[index];
        });
      }
    }
  </script>
@endpush
