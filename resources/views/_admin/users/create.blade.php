<div class="pageheader">
  <div class="col-sm-12">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fas fa-user-plus s28"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a><i class="glyphicon glyphicon-home"></i></a></li>
          <li><a>Users</a></li>
          <li><a>@lang('users.adduser')</a></li>
        </ul>
        <h4>@lang('users.create') - @lang('users.role.'.$role) </h4>
      </div>
    </div>
  </div>
</div>

<div class="contentpanel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-btns">
        <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
        <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
      </div>
      <h4 class="panel-title text-center">@lang('users.userdata')</h4>
    </div>
    <form id="form-create-user" class="form-bordered" enctype="multipart/form-data">
      <input type="hidden" name="role" class="form-control" value="{{ $role }}"/>
      <div class="panel-body nopadding">
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.name')</label>
          <div class="col-sm-8">
            <input type="text" name="name" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.username')</label>
          <div class="col-sm-8">
            <input type="text" name="username" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.password')</label>
          <div class="col-sm-8">
            <input type="password" name="password" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.phone')</label>
          <div class="col-sm-8">
            <input type="number" name="phone" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.email')</label>
          <div class="col-sm-8">
            <input type="text" name="email" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.address')</label>
          <div class="col-sm-8">
            <input type="text" name="address" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.profileimage')</label>
          <div class="col-sm-8">
            <input type="file" name="profile_image" class="form-control" style="display:none;"/>
            <a id="select-img" class="btn btn-default btn-sm btn-block btn-bordered"><i class="fas fa-times"></i> @lang('users.createnew.noimage')</a>
            <i class="ptr fas fa-times pull-right remove-img btn btn-danger btn-sm" style="display: none;"></i>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">@lang('users.createnew.notes')</label>
          <div class="col-sm-8">
            <textarea name="notes" rows="4" style="width:100%;"></textarea>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button id="back" class="btn btn-warning"><i class="fas fa-chevron-left"></i> @lang('users.createnew.cancel')</button>
        <button id="save" type="submit" class="btn btn-primary mr5 pull-right">@lang('users.createnew.save') <i class="fas fa-chevron-right"></i></button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$('input, textarea').focus(function() {
  $(this).closest('.form-group').addClass('highlight')
});
$('input, textarea').focusout(function() {
  $('.highlight').removeClass('highlight')
});
$('#back').on('click', function(e) {
  e.preventDefault();
  $('#main-content').load('{{ url("/users/list") }}/{{ $role }}')
})
$('#select-img').on('click', function() {
  $('input[name="profile_image"]').trigger('click');
})
$('input[name="profile_image"]').on('change', function(e) {
  if (this.files && this.files[0]) {
    let reader = new FileReader();
    reader.onload = function (e) {
      $('#select-img').html('<img src="'+e.target.result+'">')
    }
    reader.readAsDataURL(this.files[0]);
    $('.remove-img').show()
  }
})
$('.remove-img').on('click', function(e) {
  $('input[name="profile_image"]').val('')
  $('#select-img').html('<i class="fas fa-times"></i> @lang('users.createnew.noimage')')
  $('.remove-img').hide()
})

$('#form-create-user').on('submit', function(e){
  e.preventDefault();
  $('#save').prop('disabled', true);

  data = new FormData($('#form-create-user')[0]);
  $.ajax({
    url: "{{ url('/api/user/store') }}",
    method: "POST",
    data: new FormData(this),
    dataType: "JSON",
    enctype: 'multipart/form-data',
    processData: false,
    contentType: false,
    cache: false,
    headers: {
      "Accept": "application/json",
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      "Authorization": "Bearer {{ Auth::user()->api_token }}",
      "X-localization": "id",
    },
    success: function(data) {
      $.gritter.add({
        title: data.messages,
        text: '...',
        image: '{{ url('/images/growl-success.png') }}',
        class_name: 'growl-success',
        sticky: false,
        time: ''
      });
      $('#main-content').load('{{ url("/users/list") }}/{{ $role }}')
    },
    error   : function ( jqXhr, json, errorThrown ) {
      $('label.error').remove()
      $('#save').prop('disabled', false);
      let res = jqXhr.responseJSON;
      if( jqXhr.status == 422)
      {
        $.each( res.errors, function( key, value ) {
          $('input[name="'+key+'"]').closest('.form-group').addClass('has-error')
          $('input[name*="'+key+'"]').closest('div').append('<label for="'+key+'" class="error">'+value+'</label>')
        });
        $.gritter.add({
          title: '@lang('validation.custom.user.createdfail')',
          text: res.message,
          image: '{{ url('/images/growl-danger.png') }}',
          class_name: 'growl-danger',
          sticky: false,
          time: ''
        });
      }
    }
  });

})
</script>
