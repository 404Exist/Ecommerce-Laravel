<div id="related_product" class="container tab-pane fade"><br>

  <div class="form-inline">
    <i class="fa fa-spin fa-spinner fa-2x d-none search_product"></i>
    <i class="fas fa-search fa-2x" aria-hidden="true" onclick="doSearch()"></i>
    <input type="text" class="form-control form-control-sm ml-3 w-75" placeholder="Search" aria-label="Search"
      id="search" onkeyup="doSearch(event)" />
  </div>

  <hr />
  <div>
    <ul class="items">

    </ul>
  </div>


</div>

@push('js')
  <script>
    function doSearch(e) {
      var doSearch = e ? (e.keyCode == 13 ? true : false) : true;
      if (search.value != '' && search.value != null && doSearch) {
        ajax({
          type: 'POST',
          url: "{{ admin_url('product/search') }}",
          data: {
            search: search.value,
            id: {{ $product->id }}
          },
          // contentType,
          dataType: "json",
          success: function(data) {
            data = JSON.parse(data.response);
            if (data.status) {
              var items = 'There\'s no results';
              if (data.totalResults > 0) {
                items = '';
                data.results.map(result => {
                  items += `
                    <li>
											<label>
												<input type="checkbox" name="related[][${result.id}]" />
												${result.title['{{ lang() }}']}
                    	</label>
                    </li>`;
                });
              }
              document.querySelector('.items').innerHTML = items;
              document.querySelector('.search_product').classList.add('d-none');
            }
          },
          beforeSend: function() {
            document.querySelector('.search_product').classList.remove('d-none');
          },
          error: function(res) {
            let response = res.responseJSON || JSON.parse(res.response);
          },
        });
      }
    }
  </script>
@endpush
