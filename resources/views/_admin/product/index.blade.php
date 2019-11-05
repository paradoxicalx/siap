<div class="pageheader">
  <div class="col-sm-8">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fas fa-boxes s28"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a><i class="glyphicon glyphicon-home"></i></a></li>
          <li><a>Product</a></li>
        </ul>
        <h4>@lang('product.list')</h4>
      </div>
    </div>
  </div>
  <div class="col-sm-4 hidden-xs" style="margin-top: 5px;">
    <button class="btn btn-info pull-right add-new">@lang('product.addnew')</button>
  </div>
</div>

<div class="contentpanel">
  <div class="row">
    <div class="col-sm-6 hidden-xs" id="btn-table"></div>
    <div class="col-sm-6 visible-xs">
      <button class="btn btn-info btn-block add-new">@lang('product.addnew')</button>
      <hr>
    </div>
    <div class="col-sm-2 mb-2">
      <div class="input-group w-100">
        <select class="select2" id="tableLength" data-placeholder="@lang("users.table.rownumber")">
          <option></option>
          <option>10</option>
          <option>50</option>
          <option>100</option>
          <option>1000</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4 mb-2">
      <div class="input-group w-100">
        <input type="text" class="form-control searchinput" id="tableSearch" placeholder="@lang("home.search")">
      </div>
    </div>
  </div>
  <div class="row">
    <hr>
    <div class="col-sm-9 mb-2">
      <table class="table nowrap table-border-bottom" id="products-table">
        <thead>
          <tr>
            <th>@lang("product.table.name")</th>
            <th>@lang("product.table.product_code")</th>
            <th>@lang("product.table.sell_price")</th>
            <th>@lang("product.table.discontinue")</th>
            <th>@lang("product.table.created_at")</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="col-sm-3">
      <div class="panel panel-primary panel-menu">
        <li class="list-group-item as-header">
          @lang("product.catagory")
        </li>
        <ul class="list-group">
          <li class="list-group-item active" data-cid="">
            <i class="far fa-circle"></i> @lang("product.all")
          </li>
          @foreach ($catagory as $item)
          <li class="list-group-item" data-cid="">
            <i class="far fa-circle"></i> {{$item->name}}
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
  $(".select2").select2({
    width: '100%',
    tags: true,
  });
  $(document).on('keypress', '.select2-search__field', function () {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
  });

  var table = $('#products-table').DataTable({
    processing      : true,
    serverSide      : true,
    responsive      : true,
    select          : true,
    pageLength      : 10,
    pagingType      : $(window).width() < 768 ? 'full'  : 'simple_numbers',
    bAutoWidth      : false,
    colReorder      : true,
    buttons         : table_button,
    order           : [[0, "dsc"]],
    dom             : "<'row'<'col-sm-12'B>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'"+
    "<'col-sm-6'i> <'col-sm-6'p>>",
    ajax            : {
      'beforeSend'  : function (request) {
        request.setRequestHeader("Authorization", 'Bearer {{ Auth::user()->api_token }}');
      },
      'url'         : '{{ url("/api/products/dt") }}/all',
      'type'        : 'GET',
    },
    columns         : [
      { data: 'name' },
      { data: 'product_code' },
      { data: 'sell_price' },
      { data: 'discontinue' },
      { data: 'created_at' },
    ],
  });

  table.buttons().container().appendTo('#btn-table')

  $('#tableSearch').keyup(function(){
    table.search($(this).val()).draw() ;
  })

  for ( i = 0 ; i < table.columns().count() ; i++ ) {
    let title = $(table.column( i ).header()).text()
    if (title == '@lang("product.table.discontinue")' ||
        title == '@lang("product.table.created_at")')
    {
      table.column(i).visible( false );
    }
  }

  $('#tableLength').on('change', function() {
    if ($(this).val() < 10 || $(this).val() == '' ) {
      var length = 10
    } else {
      var length = $(this).val()
    }
    table.page.len(length).draw();
  });

  $('.add-new').on('click', function() {
    $('#main-content').load('{{ url("/product/create") }}')
  })

  $('[data-cid]').on('click', function() {
    $('.list-group-item').removeClass('active')
    $(this).addClass('active')
  })

})
</script>
