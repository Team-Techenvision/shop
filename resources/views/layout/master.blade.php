<!DOCTYPE html>
<html>
<head>
  <title>Dr Help Desk</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  

  <!-- <link rel="shortcut icon" href=""> -->
  <link rel="shortcut icon" href="{{ asset('/1.png') }}">


  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" /> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
  @include('layout.header')
    <div class="page-wrapper">
      <div class="page-content">
        @yield('content')
      </div>
      @include('layout.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- ========================== -->
    <script>
      $(document).ready(function(){
        $(".any_message").fadeOut(4500);
      });
    </script>

    <script type="text/javascript">
          
            $("#form_date").datepicker({
              minDate: '0', 
              dateFormat: 'yy-mm-dd'
            });
            
            $("#to_date").datepicker({
              minDate: '0', 
              dateFormat: 'yy-mm-dd'
            });


            $(".cust_prod_return").click(function()
            {
              // var order_id = $(this).find('.cust_order_id span').html();
              var order_id = $('.cust_order_id span').html();

              $('.p_order_id').val(order_id);

              // alert(order_id);
            });
            $('#check_brcode_product').click(function()
            {
              // var id = $(".p_barcode").val();
              // alert($(".p_barcode").val());
              if($(".p_barcode").val())
              {
                $.ajax({
                  type: "post",          
                  url: "{{ url('br-return-cust-order')}}",
                  dataType: "json",
                  data: {"_token": "{{ csrf_token() }}",
                        "product":$(".p_barcode").val(),"order_id":$(".p_order_id").val()},
                  success : function(response){
                    if(response['data'].length > 0)
                    {
                      $(".Product_Name").val(response['data'][0].prod_name);
                      $(".p_attr_id").val(response['data'][0].id);
                      $(".Price").val(response['data'][0].sub_total);
                      $(".quantity").val(response['data'][0].quantity);
                      console.log(response);
                    }
                    else
                    {
                      $(".Product_Name , .quantity, .Price").val('');
                      $('.model_error_sms').text("Invalid Product BarCode !!!");              
                      $(".model_error_sms").css("display", "block");
                      $(".model_error_sms").fadeOut(4500);
                    }

                  } 

                });
              }
              else{
                  $('.model_error_sms').text("Please Enter Product Barcode !!!");
                  // alert("Please Enter Product Barcode!!!");
                  $(".model_error_sms").css("display", "block");
                  $(".model_error_sms").fadeOut(4500);
              }

            });

            $("#btn_return").click(function()
            {
              var return_item = $('.Return_Qty').val();
              var buy_quantity = $('.quantity').val();
              if(buy_quantity >=return_item)
              {
                return true;
              }
              else
              {
                $('.model_error_sms').text("Return Quantity Less OR Equal Buying Quantity !!!");              
                $(".model_error_sms").css("display", "block");
                $(".model_error_sms").fadeOut(4500);
                return false;
              }


            });
         
        </script>
    <!-- ======================== -->
    <!-- end common js -->
  
    @stack('custom-scripts')    
    @toastr_js
    @toastr_render   
</body>
</html>