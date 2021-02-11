




<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <div class="form-group">
            <label> Name</label>
            <input type="text" class="form-control" value="{{$user->name}}" readonly>                                     
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" value="{{$user->email}}" readonly>                                     
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" value="{{$user->phone}}" readonly>                                     
        </div>
        <div class="form-group">
            <label>Login ID</label>
            <input type="text" class="form-control" value="{{$user->phone}}" readonly>                                     
        </div>               
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">  
    <div class="card">
      <div class="card-body">
      <div class="d-flex justify-content-between">
            <h6 class="card-title">{{$page_title}}</h6>           
            <a href="#demo" class="btn btn-primary" data-toggle="collapse">Edit Profile</a>
        </div> 
        <div id="demo" class="collapse">
            <!-- <div class="card card-body"> -->
            <form action="{{url('update-profile')}}" method="post">
                @csrf
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="emp_name" value="{{$user->name}}" required>                                     
                            </div>                                  
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required>                                     
                            </div>
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="text" class="form-control" name="phone_no" value="{{$user->phone}}" minlength="10" maxlength="10" required>                                     
                            </div>
                            <div class="form-group">
                            <div class="alert alert-warning">
                                <strong>Phone No.</strong> is a your Login Id.
                            </div>                                                                  
                            </div>                                   
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger mr-2" value="Update">
                                <!-- <a href="#demo" class="btn btn-light" data-toggle="collapse">Close</a>                                                                    -->
                                <input type="reset" name="reset" class="btn btn-light" >
                            </div>                     
                        </div>
                        </div> 
                    </div>  
                </form>	 
            <!-- </div> -->
        </div> 
        <div class="any_message">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('alert-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('alert-danger') }}
                </div>
            @endif
            @if(session()->has('alert-success'))
                <div class="alert alert-success">
                    {{ session()->get('alert-success') }}
                </div>
            @endif
        </div>                
      </div>
    </div>
  </div>
</div>

