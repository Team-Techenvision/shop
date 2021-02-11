<div class="container">
<div class="jumbotron jumbotron-fluid">
  <div class="container">  
   <form class="w-75 m-auto" action="{{url('print-barcode')}}" method="post">
    @csrf
        <div class="d-flex">
            <div class="form-group w-25 mr-3">
                <label for="barcode_no">BarCode No :</label>
                <input type="text" class="form-control border border-info text-center" value="{{$barcode}}"  name="barcode" readonly>
            </div>
            <div class="form-group w-25 mr-3">
                <label for="print_no">Enter Number Print:</label>
                <input type="number" class="form-control border border-info text-center" value="1" min="1" name="quantity" required>
            </div>
            <div class="w-25 pt-4">        
                 <button type="submit" name="btn_print" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print BarCode</button>
            </div>                
        </div> 
    </form>
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
</div>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
      $(document).ready(function()
      {
        $('.any_message').fadeOut(5500);
      });
         
      </script>  
