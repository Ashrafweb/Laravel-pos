@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
@if($data->name!=="") 
      <div class="mr-3"><a href="{{url('/categories')}}"><button class="btn btn-primary">Back
      </button></a></div>
    @endif
<div class="col-lg-6 my-3">
              
                            @if(session('success')) 
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                            @if(session('failed'))
                                <div class="alert alert-danger">{{session('failed')}}</div>
                            @endif
                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <strong class="text-lg">variation</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form col-10' method="post" action="{{url('variation/insert')}}">
                                            @csrf
                                        <div class="form-group">
                                           
                                            <input type="text" id="name" name="name"  class="shadow-none form-control" autocomplete="off" value="{{old('name',$data->name)}}">
                                            <label for="name" class="form-label">Name</label>
                                        </div>

                                        @error('name')

                                           <div class="alert alert-danger">{{$message}}</div>                 

                                        @enderror
                                        
                                      
                                       <div class="row">
                                           
                                       <div class="col-6">
                                           <div class="form-group">
      
                                            <input type="text" class=" outline-0" name="variation[]" />
                                            <div id="variations">

                                            </div>
                                           
                                           </div>
 
                                           </div>
                                           <div class="col-4">
                                             <button class="btn btn-sm btn-success m-2 shadow-none" type="button" onClick='addfield()'>Add</button>
                                           </div>
                                       </div>
                        
                                       @if($data->name!=="")
                                       <input type="hidden" value="{{$data->id}}" name="updateId" />
                                      
                                       <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                       @else 
                                        <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                       @endif
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
</div>   

<script>
function addfield (){
 // var fields = document.getElementById('variations').innerHTML;
 // alert(fields);
  //var fields = fields+"<input type='text' class='my-2' name='variation[]' />";
 // $('#variations').html(fields);

 var field = document.getElementById('variations');
var newfield = document.createElement('input');
newfield.name = "variation[]";
newfield.style.marginTop="10px";
field.append(newfield);
    
}
</script>
@endsection