@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper bg-info">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="{{url('/')}}" class="noble-ui-logo d-block mb-2">Dr <span>Help Desk</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
              
              <form class="forms-sample" method="post" action="{{url('/post-login')}}">
              @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1"> Mobile No </label>
                  <input type="number" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Mobile No"  required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" required>
                </div>               
                <div class="mt-3">
                  <button class="btn btn-primary mr-2 mb-2 mb-md-0">Login </button>
                  <!-- <a href="{{ url('home-bash') }}" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</a> -->
                  <!-- <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                    Login with twitter
                  </button> -->
                </div>                 
              </form>
              <div class="mt-5">
              @if(session()->has('message'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
            </div>
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@toastr_js
    @toastr_render   
@endsection