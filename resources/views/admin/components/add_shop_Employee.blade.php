<div class="col-md-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title}}</h3>	
                        <form action="{{url('submit-employee')}}" method="post">
                        @csrf
                            <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name" required>                                     
                                    </div> 
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email">                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Phone No</label>
                                        <input type="text" class="form-control" name="phone_no" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" required>                                     
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Store Name</label>
                                        <input type="text" class="form-control" name="store_name" required>                                     
                                    </div> --> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input type="text" class="form-control" name="user_name" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-2">
                                        <input type="reset" class="btn btn-sccess">                            
                                    </div>
                                </div>
                                </div> 
                          </div>  
                        </form>		
                    </div> 
                </div>    
            </div>