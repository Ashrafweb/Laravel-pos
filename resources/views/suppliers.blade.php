@extends('layout.app')
@section('content')
<div class="container-fluid">
                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                            
                            @if(session('failure'))
                                <div class="alert alert-danger">{{session('failure')}}</div>
                            @endif
                            <div id="ajax-msg"></div>
       <div class="title text-left bg-light">
          <h4 class="fw-bold"Suppliers</h4>
       </div>
        <div class="card shadow mb-4">
             <div class="card-body">
                      
             <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                   
                      <th>Supplier</th>
                      <th>email</th>
                      <th>address</th>
                      <th>Phone</th>
                      <th>City</th>
                      <th>Status</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($suppliers as $supplier)
                    <tr>
                      
                      <td>{{$supplier->name}}</td>
                      <td>{{$supplier->email}}</td>
                      <td>{{$supplier->address}}</td>
                      <td>{{$supplier->phone}}</td>
                      <td>{{$supplier->city}}</td>
                      <td>
                       @if($supplier->status==1)
                      <button class="btn btn-success py-1" onclick="deactivate({{$supplier->id}})">Active</button>   
                       @else 
                       <button class="btn btn-warning py-1" onclick="activate({{$supplier->id}})">Deactive</button>
                       @endif
                      </td>
                      <td>{{$supplier->created_at->diffForHumans()}}</td>    
                      <td>
                        <a href="{{url('supplier/edit/'.$supplier->id)}}"><button class="btn btn-light btn-sm  shadow-none"><i class="fa fa-pen text-primary"></i></button></a>
                        <a href="{{url('supplier/delete/'.$supplier->id)}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light btn-sm shadow-none"><i class="fa fa-trash text-danger"></i></button></a>
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
         url : 'supplier/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'activate', 
                  
                  },
         success : function(result){
           if(result=="success"){
             location.reload();
           //   jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
           }
         }
    });
  }

  function deactivate(id){
    jQuery.ajax({
         url : 'supplier/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'deactivate', 
                  
                  },
         success : function(result){
           if(result=="success"){
              location.reload();
             // jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
           }
         }
    });
  }
</script>



@endsection