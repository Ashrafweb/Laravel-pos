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
          <h4 class="">Variations</h4>
       </div>
        <div class="card shadow mb-4">
             <div class="card-body">
                      
             <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    
                      <th>Variation</th>      
                      <th>Status</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($variations as $variation)
                    <tr>
                      <td>{{$variation->name}}</td>   
                      <td id="{{$variation->id}}">
                       @if($variation->status==1)
                          <button class="btn btn-success py-1 shadow-none outline-0" onclick="deactivate({{$variation->id}})">Active</button>
                       @else 
                       <button class="btn btn-warning py-1 shadow-none outline-0" onclick="activate({{$variation->id}})">Deactive</button>
                       @endif
                      </td>
                      <td>@if($variation->created_at){{$variation->created_at->diffForHumans()}}@endif</td>    
                      <td class="d-flex">
                        <a href="{{url('variation/edit/'.$variation->id)}}"><button class="btn btn-light shadow-none mr-1"><i class="fa fa-pen text-primary"></i></button></a>
                        <a href="{{url('variation/delete/'.$variation->id)}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light shadow-none"><i class="fa fa-trash text-danger"></i></button></a>
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
         url : 'variation/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'activate', 
                  
                  },
         success : function(result){
           if(result=="success"){
            // location.reload();
           //   jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
           jQuery(`#${id}`).html(`<button class='btn btn-success py-1 shadow-none outline-0' onclick='deactivate(${id})'>Active</button>`);
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
           }
         }
    });
  }

  function deactivate(id){
    jQuery.ajax({
         url : 'variation/status/'+id,  
         method: 'post',
         data : {
          "_token" : '{{csrf_token()}}',
                  'id':id,
                  'action': 'deactivate', 
                  
                  },
         success : function(result){
           if(result=="success"){
             // location.reload();
             // jQuery('#ajax-msg').html("<div class='alert alert-success'>Status Updated</div>'");
             jQuery(`#${id}`).html(`<button class='btn btn-warning py-1 shadow-none outline-0' onclick='activate(${id})'>Deactive</button>`);
           }else if(result=="failed"){
            jQuery('#ajax-msg').html("<div class='alert alert-danger'>Failed To Update Status</div>'");
            
           }
         }
    });
  }
</script>







@endsection