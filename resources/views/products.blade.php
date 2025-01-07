@extends('layout.app')
@section('content')
<div class="container-fluid">
                @if(session('message'))
                       <div class="alert alert-danger p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
       <div class="title text-left bg-light d-flex justify-content-between pb-2">
          <h4 class="">Products</h4>
          <div>
          <a href="{{ route('file-export') }}"><button class="btn btn-primary">Export</button></a>
          <button class='btn btn-success' type="button" data-toggle='modal' data-target="#formmodal" >Import</button>
          </div> 
       </div>
        <div class="card shadow mb-4">
             <div class="card-body">
                      
             <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Name</th>
                      <th>code</th>
                      <th>Quantity</th>
                      <th>category</th>
                      <th>Godaun</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td> <img src="{{asset('storage/media/'.$product->image)}}" width="40px" height="40px"/></td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->code}}</td>
                      <td>{{$product->qty}}</td>
                      <td>{{$product->category_id}}</td>
                      <td>{{$product->godaun}}</td>
                      <td id="{{$product->id}}status">
                       @if($product->status==1)
                          <button class="btn btn-success py-1" onclick="deactivate({{$product->id}})">Active</button>
                       @else 
                       <button class="btn btn-warning py-1" onclick="activate({{$product->id}})">Deactive</button>
                       @endif
                      </td>
                      <td>
                          <a href="{{url('products/edit/'.$product->id)}}"><button class="btn btn-light py-1  shadow-none"><i class="fa fa-pen text-primary"></i></button></a>
                          <a href="{{url('products/delete/'.$product->id)}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light py-1 shadow-none"><i class="fa fa-trash text-danger"></i></button></a>
                      </td>             
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

             
             </div>
            
             
             
            </div>
          </div>

          </div> 





          <script src="{{asset('admin_assets/js/jquery.min.js')}}"></script>

<script>
  function activate(id){
    jQuery.ajax({
         url : 'product/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'activate', 
                  
                  },
         success : function(result){
           if(result=="success"){
           //  location.reload();
           //   jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
           jQuery(`#${id}status`).html(`<button class='btn btn-success py-1' onclick='deactivate(${id})'>Active</button>`);
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
           }
         }
    });
  }

  function deactivate(id){
    jQuery.ajax({
         url : 'product/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'deactivate', 
                  
                  },
         success : function(result){
           if(result=="success"){
            //  location.reload();
             // jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
             jQuery(`#${id}status`).html(`<button class='btn btn-warning py-1' onclick='activate(${id})'>Deactive</button>`);
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
           }
         }
    });
  }
</script>






         
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
                                    
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                           <div class="py-1">
                           <a href="{{ route('file-export') }}"><button class="btn btn-success" type="submit">Import</button></a>
                           </div>
                        </div>

                    </form>        
                </div>
            
          </div>
    </div>

</div>

@endsection