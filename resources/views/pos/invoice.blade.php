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
               <h6 class="text-black">Order Status : <span>Pending</span></h6> 
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
                   @foreach($cart_products as $item)
                    <tr>
                      <td>{{$item->name}}</td>
                      <td>{{$item->qty}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->qty * $item->price}}</td>
                     
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
                <button class="btn btn-primary mx-2 border-0 rounded-0 shadow-none"><i class="fa fa-download"></i></button>
                <button class='btn btn-success border-0 rounded-0 shadow-none' data-toggle='modal' data-target="#formmodal" >Proceed</button>

              </div>
            </div>
          </div>

          </div>


<div class="modal fade" id='formmodal' tabindex='-1' role="dialog" aria-labelledby='formmodallabel' aria-hidden='true'>

  <div class="modal-dialog" role='document'>
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 class="modal-title text-primary ml-3 fw-bold" id="formmodallabel">Invoice of {{$customer->name}} </h5>
        <h5 class="modal-title text-primary ml-3 fw-bold">Total : {{$total}}</h5>
        
      </div>
      <div class="modal-body">
           <form action="{{url('pos/invoice')}}" method="post">
           @csrf


              <div class="form-group row">

                   <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="">Payment</label>
                        <select name="payment" id="payment_type" class="form-control form-control-user rounded-0">
                            <option value="Handcash">Handcash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Due">Due</option>
                        </select>
                   </div>

                   <div class="col-sm-4">
                    <label for="paid">Paid</label>
                    <input type="number" class="form-control form-control-user rounded-0" name="paid" id="paid" placeholder="">

                                     @error('due')
                                         <div class="alert alert-danger">{{$message}}</div>
                                      @enderror

                   </div>

				   <div class="col-sm-4">

                    <label for="due">Due</label>
                    <input type="number" class="form-control form-control-user rounded-0" name="due" id="due" placeholder="">

                                      @error('due')
                                         <div class="alert alert-danger">{{$message}}</div>
                                      @enderror

                   </div>

                </div>



     
                
                <div class="d-flex flex-row justify-content-end py-3 mt-3">
                    <button class="btn-sm bg-transparent border-dark text-black mx-2  shadow-none" type="button"  data-dismiss="modal" aria-label='close'>Close</button>
                    <button class='btn-sm btn-primary border-0 shadow-none' data-toggle='modal' data-target="#formmodal" type="submit" >Submit</button>
                </div>
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <input type="hidden" name="customer_name" value="{{$customer->name}}">
                <input type="hidden" name="total" value="{{$total}}">
                <input type="hidden" name="order_id" value="{{$order_id}}">
           </form>

  




     </div>
    </div>
   </div>
  
</div> 
    
@endsection