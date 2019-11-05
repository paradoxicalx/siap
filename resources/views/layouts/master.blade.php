<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistem Informasi Akuntansi dan Penjualan</title>

  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/siap.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/select2-bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/fontawesome/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/css/jquery.gritter.css')}}">

</head>

<body>
  <header>
    <div class="headerwrapper">
      <div class="header-left">
        <a href="index.html" class="logo">
          <img src="images/logo.png" alt="" />
        </a>
        <div class="pull-right">
          <a href="" class="menu-collapse">
            <i class="fa fa-bars"></i>
          </a>
        </div>
      </div>

      <div class="header-right">
        <div class="pull-right">
          <form class="form form-search hidden-xs" action="search-results.html">
            <input type="search" class="form-control" placeholder="@lang('home.search')" />
          </form>
          <div class="btn-group btn-group-list btn-group-notification">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              <span class="badge">0</span>
            </button>
            <div class="dropdown-menu pull-right">
              <a href="" class="link-right"><i class="fas fa-search"></i></a>
              <h5>@lang('home.notification')</h5>
              <ul class="media-list dropdown-list">
              </ul>
              <div class="dropdown-footer text-center">
                <a href="" class="link">@lang('home.seeallnotif')</a>
              </div>
            </div>
          </div>

          <div class="btn-group btn-group-list btn-group-messages">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-envelope"></i>
              <span class="badge">0</span>
            </button>
            <div class="dropdown-menu pull-right">
              <a href="" class="link-right"><i class="fas fa-plus"></i></a>
              <h5>@lang('home.newmessages')</h5>
              <ul class="media-list dropdown-list">
              </ul>
              <div class="dropdown-footer text-center">
                <a href="" class="link">@lang('home.seeallmessages')</a>
              </div>
            </div>
          </div>

          <div class="btn-group btn-group-option">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-caret-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="#"><i class="glyphicon glyphicon-user"></i> @lang('home.myprofile')</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-star"></i> @lang('home.activitylog')</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-cog"></i> @lang('home.accountsettings')</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="glyphicon glyphicon-log-out"></i>@lang('home.signout')</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section>
    <div class="mainwrapper">
      <div class="leftpanel">
        <div class="media profile-left">
          <a class="pull-left profile-thumb" href="profile.html">
            <img class="img-circle" src="images/photos/profile.png" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">{{ Auth::user()->username }}</h4>
            <small class="text-muted">{{ Auth::user()->name }}</small>
          </div>
        </div>

        <h5 class="leftpanel-title">@lang('home.navigation')</h5>
        <ul class="nav nav-pills nav-stacked">
          @yield('sidebar')

        </ul>
      </div>

      <div class="mainpanel" id="main-content">

      </div>
    </div>
  </section>


  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/js/modernizr.min.js') }}"></script>
  <script src="{{ asset('/js/pace.min.js') }}"></script>
  <script src="{{ asset('/js/select2.min.js') }}"></script>
  <script src="{{ asset('/js/retina.min.js') }}"></script>
  <script src="{{ asset('/js/jquery.cookies.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/siap.js') }}"></script>
  <script src="{{ asset('js/jquery.gritter.min.js') }}"></script>
  <script src="{{ asset('/datatables/datatables.min.js') }}"></script>

</body>
</html>
