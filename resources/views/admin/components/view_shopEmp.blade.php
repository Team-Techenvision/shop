
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th> 
                <th>First Name</th> 
                <!-- <th>Last Name</th> -->
                <th>Email</th>  
                <th>Phone</th>
                <th>User Id</th> 
                <th>Password</th>                  
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($shop_Employee as $row)
            <tr>
                <th><?php echo $i; ?></th> 
                <th>{{$row->name}}</th>
                <!-- <th>{{$row->name}}</th>    -->
                <th>{{$row->email}}</th>               
                <th>{{$row->phone}}</th>
                <th>{{$row->phone}}</th> 
                <th>{{$row->password}}</th>                  
              </tr>
              <?php $i++; ?>
            @endforeach             
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>