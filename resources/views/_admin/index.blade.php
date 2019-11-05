@extends('layouts.master')

@section('sidebar')
<li><a class="ptr loadhtml" data-url="{{ url('/dashboard') }}"><i class="fa fa-home"></i> <span>@lang('home.sidebar.dashboard')</span></a></li>
<li class="parent"><a class="ptr"><i class="fa fa-user"></i> <span>@lang('home.sidebar.users')</span></a>
    <ul class="children">
        <li><a class="ptr loadhtml" data-url="{{ url('/users/list/admin') }}">@lang('home.sidebar.admin')</a></li>
        <li><a class="ptr loadhtml" data-url="{{ url('/users/list/partner') }}">@lang('home.sidebar.partner')</a></li>
        <li><a class="ptr loadhtml" data-url="{{ url('/users/list/customer') }}">@lang('home.sidebar.customers')</a></li>
    </ul>
</li>
<li><a class="ptr loadhtml" data-url="{{ url('/products') }}"><i class="fa fa-users"></i> <span>@lang('home.sidebar.product')</span></a></li>
@stop
