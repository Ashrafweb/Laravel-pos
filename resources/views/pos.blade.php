
@extends('layout.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow border-0">
              <div class="card-header bg-white text-center">
                  <strong class="text-lg text-success">Confirm Sale</strong>
              </div>
             
                <div class="card-body p-0">

                    <div class="card border-0">

                       <div class="card-body text-center">
                                                 
                              <div class="table-responsive">
                                <table class="table  text-center" width="100%" cellspacing="0">
                               
                                    <tbody class="cart">
                                      @if(count($pos_data)>0)
                                         @foreach($pos_data as $data)
                                           <tr>
                                           <td><input class='hidden_id' type='hidden' value="{{$data->product_id}}"></td>
                                            <td> <img src="{{asset('storage/media/'.$data->image)}}" width="40px" height="40px"/></td>
                                             <td>{{$data->name}}</td>
                                             <td><input type='number'class='input-sm ' min="1" max="50" id="qty{{$data->product_id}}" value='{{$data->qty}}' onchange="updateqty({{$data->product_id}},{{$data->price}})" /></td>
                                             <td id="price{{$data->product_id}}">{{$data->price}}</td>
                                             <td><i class='fa fa-times' onclick="removecart({{$data->product_id}})"></i></td>

                                          </tr>
                                         @endforeach
                                      @else 
                                      <strong class="text-lmd empty-txt text-dark">No product added yet.</strong>   
                                      @endif
                                    </tbody>
                                </table>
                              </div>
           
                      </div>

                    </div>
                    <div class="card bg-primary border-0 rounded-0">

                      <div class="card-body text-center">
                             <strong class="text-lg text-white" id="total_price">Total : 0  </strong> 
                            <div> <strong class="text-lmd text-white" id="tax">Tax : 0 </strong> </div>
                      </div>

                    </div>

                    <div class="card  border-0 rounded-0">
                    
                      <div class='card-body text-center'>
                      <form action="{{url('pos/sellcart')}}" method="post">
                          @csrf
                        <div><strong>Select Customer</strong></div>
                              <div class="row pt-3">
                                <div class="col-6">
                                   <div class="pt-3">
                                      <select name="customer" id="" class="form-select">
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)

                                                <option value='{{$customer->id}}'>{{$customer->name}}</option>

                                            @endforeach
                                      </select>
                                    </div>
                              
                                </div>
                              
                              <div class="col-6 pt-2">
                              
                                <button class='btn btn-success border-0 rounded-1 shadow-none' type="button" data-toggle='modal' data-target="#formmodal" >Add New</button>
                              
                              
                              </div>
                              
                              
                              </div>
                    
                      </div>
                    </div>

                    <div class="card border-0 rounded-0">
                        <div class="card-body">
                           <button class="btn btn-primary border-0 shadow-none rounded-0 btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div> 
      <div class="col-lg-7">
            <div class="card  shadow border-0">
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Add</th>
                    

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Product</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Add</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  @foreach($products as $product)
                    <tr>
                      <td> <img src="{{asset('storage/media/'.$product->image)}}" width="40px" height="40px"/></td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->selling_price}}</td>
                      <td>{{$product->qty}}</td>
                      <td><i class="fa fa-shopping-cart" onclick="addproduct({{$product->id}},{{$product->selling_price}},{{$product->qty}},'{{$product->name}}','{{$product->image}}')"></i></td>
                    </tr>
                  @endforeach 
                             
                  </tbody>
                </table>
              </div>
            </div>
          </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id='formmodal' tabindex='-1' role="dialog" aria-labelledby='formmodallabel' aria-hidden='true'>

  <div class="modal-dialog" role='document'>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary ml-3 fw-bold" id="formmodallabel">Add Customer</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label='close'>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                          <form class='styled_form px-3' method="post" action="{{url('customer/insert')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" id="name" name="name"  class="shadow-none form-control" autocomplete="false"  value="{{old('name')}}">
                                            <label for="name" class="form-label">Name</label>
                                        </div>

                                        @error('name')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 

                                        <div class="form-group">
                                           
                                            <input type="email" id="email" name="email" class="form-control shadow-none" autocomplete="off" value="{{old('email')}}" >
                                            <label for="email" class=" form-label">Email</label>

                                        </div>

                                        @error('email')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        
                                        <div class="form-group">
                                           
                                            <input type="number" id="phone" name="phone" class="form-control shadow-none" autocomplete="false"  value="{{old('phone')}}">
                                            <label for="phone" class="form-label">Phone</label>

                                        </div>

                                        @error('phone')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 

                                        <div class="row">

                                            <div class="col-6">
                                               <div class="form-group">
                                                  
                                                    <input type="text" id="address" name="address" class="form-control shadow-none "autocomplete="off"  value="{{old('address')}}">
                                                    <label for="address" class="form-label">Address</label>

                                                </div>
                                                @error('address')
                                                   <div class="alert alert-danger">{{$message}}</div>
                                                @enderror 

                                            </div>    

                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                    <input type="text" id="city" name="city" class="form-control shadow-none "autocomplete="off"  value="{{old('city')}}">
                                                    <label for="city" class="form-label">City</label>
                                                </div>   

                                                @error('city')
                                                     <div class="alert alert-danger">{{$message}}</div>
                                                @enderror                 

                                            </div>

                                           

                                         </div>
                                         
                                                <div class="form-group">
                                                  
                                                    <input type="text" id="company_name" name="company_name" class="form-control shadow-none "autocomplete="off"  value="{{old('company_name')}}">
                                                    <label for="company_name" class="form-label">Company(optional)</label>
                                                </div>   

                                                @error('company_name')
                                                      <div class="alert alert-danger">{{$message}}</div>
                                                @enderror                                
                                    
                                      
                                       

                                      
                                        <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                          </form>
      </div>
      
    </div>
  </div>

</div>
  




  <script src="{{asset('admin_assets/js/jquery.min.js')}}"></script>

<script>
 
  get_total_price();

  // function get_cart_id(id){
  //   $.ajax({
  //     url : 'get_cart_id',
  //     method : 'post',
  //     data : {   
  //                'id' : id,
  //                '_token' : '{{csrf_token()}}'
  //     },
  //     success : function (result){
  //        return result ;
  //     }
  //   });
  // };

  function addproduct(id,price,qty,name,image){
  
    
   
    var match = '';
    $('.empty-txt').html("");
    var src="http://127.0.0.1:8000/storage/media/"+image;
     var text = "<tr> <td><input class='hidden_id' type='hidden' value='"+id+"'></td><td><img src='"+src+"' width='40px' height='40px'/></td><td>"+name+"</td><td class='col-3'><input id='qty"+id+"' type='number' min='1' max='50' onchange='updateqty("+id +","+price+")' class='input-sm form-number' value='1' /></td><td id='price"+id+"'>"+price+"</td><td><i class='fa fa-times' onclick='removecart("+id+")' /></td></tr>";
    var carttext = $('.cart').html();

    if($('.hidden_id').val()){

      $('.hidden_id').each(
        function(){
          if($(this).val()==id){
              match = 'true' ;
          }else{
               
          }
        });

        if(match!=='true'){
          $('.cart').html(carttext+text);
          
      jQuery.ajax({
         url : 'posdata',
        
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'name': name,
                  'price':price,
                  'image': image
                  
                  },
         success : function(result){
           alert(result);
           get_total_price();
         }

      });
        }else{
          alert('no');
        };  
    }else{

      $('.cart').html(text);
      
      jQuery.ajax({
         url : 'posdata',
        
         method: 'post',
         data : {
                  "_token" : '{{csrf_token()}}',
                  'id':id,
                  'name': name,
                  'price':price,
                  'image':image
                  
                  },
                  
         success : function(result){
           alert(result);
           get_total_price();
         }

      });
    }

   
   
  }

  function removecart(pro_id){
    jQuery.ajax({
         url : 'posdata/delete',
        
         method: 'post',
         data : {
                  "_token" : '{{csrf_token()}}',
                  'pro_id':pro_id,
                  },
                  
         success : function(result){
           if(result=='success'){
            get_total_price();
            location.reload();
           }else{
             alert("Failed");
           }
         }

      });
  }

  function updateqty(pro_id,pro_price){
   
   var qty = $("#qty"+pro_id).val() ;

   if(qty > 50 || qty < 1){
    $("#qty"+pro_id).style.border="1px solid red";
    alert("error");
   }else{
    $.ajax({
     url : 'posdata/update_qty',
     method : 'post',
     data : {
                  "_token" : '{{csrf_token()}}',
                  
                  'qty':qty,
                  'pro_id':pro_id
                  },
     success : function (result){
       if(result=='success'){
         $('#price'+pro_id).html(qty*pro_price);
         get_total_price();
       }else{
       //  alert(result);
       }
     }             
   })


   }
  
   
  }
  function get_total_price(){
    $.ajax({
      url : "/pos/get_total_price",
      method : 'get',
      data : {
        "_token" : "{{csrf_token()}}"

      },
      success : function(result){
        $('#total_price').html('Total : '+result);
      }
    })
  }



 
</script> 

@endsection