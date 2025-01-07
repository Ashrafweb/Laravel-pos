@extends('layout.app')
@section('content')
<div class="container">
                @if(session('message'))
                       <div class="alert alert-danger p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
       <div class="title text-left bg-light">
          <h4 class="">INVOICE</h4>
       </div>
        <div class="card shadow mb-4">
           
            <div class="card-body">
           
            <div class="top d-flex justify-content-between pb-3">
                <strong>Laravel Pos</strong>
                <strong>#Invoice <br>{{date('d-m-y')}}</strong>
            </div>
            <div class="d-flex justify-content-between pb-3">
            <div class="customer-detail py-4">
                   <h6 class="text-black">NAME : <span class='text-dark fw-normal'>{{$customer->name}}</span> </h6>
                   <h6 class="text-black">Phone : <span class='text-dark'>{{$customer->phone}}</span> </h6>
                   <h6 class="text-black">Address : <span class='text-dark'>{{$customer->address}}</span></h6>
                   <h6 class="text-black">City : <span class='text-dark'>{{$customer->city}}</span> </h6>
            </div>

            <div class="order py-4">
               <h6 class="text-black">Order Status : <span>{{$customer_id->order_status}}</span></h6> 
               <h6 class="text-black">Order Date : <span>{{date('d-m-y')}}</span></h6> 
               <h6 class="text-black">Order ID : <span>{{$order_id}}</span></h6> 
               
            
            </div>
            
            </div>
              
              <h6 class="px-1 font-weight-bold text-primary">Items</h6>
    
               
              <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Unit Cost</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($products as $item)
                    <tr>
                      <td>{{$item->name}}</td>
                      <td>{{$item->qty}}</td>
                      <td>{{$item->unit_price}}</td>
                      <td>{{$item->qty * $item->unit_price}}</td>
                     
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="d-flex flex-column align-items-end">
                <h6>Subtotal : 0</h6>
                <h5 class="text-black">Total : {{$total}}</h5>
              </div>
            
              <div class="d-flex flex-row justify-content-end py-3 mt-3">
                <a href="{{url('orders/verify/download_pdf_invoice/'.$order_id)}}"><button class="btn btn-success mx-2 border-0 rounded-0 shadow-none"><i class="fa fa-download"> Download Pdf </i></button></a>
                @if($customer_id->order_status=='pending')
                <form method="post" action= "{{url('orders/verify/success')}}">
                @csrf
                <input type="hidden" name="order_id" value="{{$order_id}}" />
                <button class='btn btn-primary border-0 rounded-0 shadow-none' type="submit" data-toggle='modal' data-target="#formmodal" >Verify</button>
                @else
                @endif   
           </div>
           </form>
              </div>
            </div>
          </div>

          </div> 



@endsection

