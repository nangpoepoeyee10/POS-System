@extends('admin.layout.app')
@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-10 m-5">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{ url('roles') }}" style="">Roles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('permissions') }}">Permissions</a>
                </li>
              </ul>
            </div>

    </div>
</div>

    @yield('rolePermission')
@endsection

