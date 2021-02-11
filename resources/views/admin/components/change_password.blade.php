<div class="col-md-8 m-auto"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">{{$page_title}}</h3>	
                        <form action="{{url('submit-Password')}}" method="post">
                        @csrf
                            <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 m-auto">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_pass" required>                                     
                                    </div>                                    
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="new_pass" minlength="5" maxlength="10" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_pass" minlength="5" maxlength="10" required>                                     
                                    </div>                                    
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-2">
                                        <input type="reset" class="btn btn-light">                            
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
                        </form>		
                    </div> 
                </div>    
            </div>
            
            
    