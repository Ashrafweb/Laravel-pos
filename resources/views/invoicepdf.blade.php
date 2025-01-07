<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>
<!-- 
  <link href="{{asset('admin_assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
 
-->
  <!-- <link href="{{asset('admin_assets/css/sb-admin-2.css')}}" rel="stylesheet">  -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
.flexstyle .f-1{
    
   
}
.flexstyle .f-2{
   margin-left : 70%;
   margin-top : -80px;
}
.flexstyle {
    display : block;
    margin-top : 100px;

    
}

.flexstyle .f-3{
   margin-left : 70%;
   margin-top : -40px;
}
</style>

</head>

<body>
<div class="container">
              
               
        <div class="my-4 ">
           
            
           
                <div class="flexstyle">
                    <strong class="f-1">Laravel Pos</strong>
                    <div  class="f-3"><strong>#Invoice <br>{{date('d-m-y')}}</strong></div>
                </div>

                <div class="flexstyle">
                        <div class="customer-detail f-1">
                            <h6 class="text-black">NAME : <span class='text-dark fw-normal'>{{$customer->name}}</span> </h6>
                            <h6 class="text-black">Phone : <span class='text-dark'>{{$customer->phone}}</span> </h6>
                            <h6 class="text-black">Address : <span class='text-dark'>{{$customer->address}}</span></h6>
                            <h6 class="text-black">City : <span class='text-dark'>{{$customer->city}}</span> </h6>
                        </div>

                        <div class="order f-2">
                            <h6 class="text-black">Order Status : <span>{{$customer_id->order_status}}</span></h6> 
                            <h6 class="text-black">Order Date : <span>{{date('d-m-y')}}</span></h6> 
                            <h6 class="text-black">Order ID : <span>{{$order_id}}</span></h6> 
                        
                        
                        </div>
                
                </div>
              
            
    
               
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

                    <div class="flexstyle">
                        <h6 class="f-1">Subtotal : 0</h6>
                        <h5 class="text-black f-2">Total : {{$total}}</h5>
                    </div>
            
              
        
        
    
    </div>

</div> 



</body>

</html>
