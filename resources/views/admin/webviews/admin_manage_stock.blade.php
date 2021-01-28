@extends('layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{$main_breadcrum}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$page_title}}</li>
  </ol>
</nav>
            @if($flag == 1)
            	@include('admin.components/admin_view_stock')
            @elseif($flag == 2)
            	@include('admin.components/admin_add_stock')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_stock')
            @elseif($flag == 4)
            @include('admin.components/admin_update_stock')
            @elseif($flag == 5)
            	@include('admin.components/admin_delete_stock')
            @elseif($flag == 6)
            	@include('admin.components/admin_customer_order')
            @elseif($flag == 7)
            	@include('admin.components/add_cust_order')      
            @endif
        </div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush