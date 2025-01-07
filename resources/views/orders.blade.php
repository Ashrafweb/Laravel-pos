@extends('layout.app')
@section('content')
<div class="container-fluid">
                @if(session('message'))
                       <div class="alert alert-danger p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
       <div class="title text-left bg-light">
          <h4 class="">Pending Orders</h4>
       </div>
        <div class="card shadow mb-4">
             <div class="card-body">
                      
             <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Total</th>
                      <th>Payment</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Status</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($orders as $order)
                    <tr>
                      <td>{{$order->order_unique_id}}</td>
                      <td>{{$order->customer_name}}</td>
                      <td>{{$order->total_price}}</td>
                      <td>{{$order->payment}}</td>
                      <td>{{$order->paid}}</td>
                      <td>{{$order->due}}</td>
                      <td>
                       @if($order->order_status=="success")
                       <span class="badge badge-success fw-bold text-uppercase">{{$order->order_status}}</span>
                       @elseif($order->order_status=="pending")
                       <span class="badge badge-warning fw-bold text-uppercase">{{$order->order_status}}</span>
                      
                       @elseif($order->order_status=="failure")
                       <span class="badge badge-danger fw-bold text-uppercase">{{$order->order_status}}</span>
                  
                       @elseif($order->order_status=="onway")
                       <span class="badge badge-primary fw-bold text-uppercase py-1">{{$order->order_status}}</span>
                       @endif
                    
                     
                      
                      </td>
                      <td>{{$order->created_at->diffForHumans()}}</td>    
                      <td><a href="{{url('orders/verify/'.$order->order_unique_id)}}"><button class="btn btn-primary py-1 rounded-1 shadow-none">view</button></a></td>             
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

             
             </div>
            
             
             
            </div>
          </div>

          </div> 







@endsection