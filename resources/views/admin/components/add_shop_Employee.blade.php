<div class="col-md-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">{{$page_title}}</h3>	
                        <form action="{{url('submit-employee')}}" method="post">
                        @csrf
                            <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 m-auto shadow-lg p-2 rounded">
                                    <div class="form-group">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" name="emp_name" required>                                     
                                    </div>                                   
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email">                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Phone No</label>
                                        <input type="text" class="form-control" name="phone_no" minlength="10" maxlength="10" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" maxlength="8" value="12345" readonly>                                     
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
            
            
    