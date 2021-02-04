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
              <a href="#" class="noble-ui-logo d-block mb-2">Dr <span>Help Desk</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
              
              <form class="forms-sample" method="post" action="{{url('shop-home')}}">
              @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address / Mobile No </label>
                  <input type="text" name="login_id" class="form-control" id="exampleInputEmail1" placeholder="Email / Mobile No" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="login_pass" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" required>
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
@endsection