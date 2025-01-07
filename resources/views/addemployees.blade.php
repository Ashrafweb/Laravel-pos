@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
    @if($data->name!="") 
      <div class="mr-3"><a href="{{url('/employees')}}"><button class="btn btn-success">Back
      </button></a></div>
    @endif
<div class="col-lg-7 my-3 px-3">
    
                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                            @if(session('failure'))
                                <div class="alert alert-danger">{{session('failure')}}</div>
                            @endif
                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <strong class="text-primary text-lg">Employee</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded mx-3">
                                        <form class='styled_form px-3' method="post" action="{{url('employees/insert')}}" enctype="multipart/form-data"> 
                                            @csrf
                                        <div class="form-group">
                                           
                                            <input type="text" id="name"  name="name" value="{{old('name',$data->name)}}" class="shadow-none form-control" autocomplete="false">
                                            <label for="name" class="form-label">Name</label>
                                        </div>
                                       
                                        @error('name')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">
                                           
                                            <input type="email" id="email" name="email" value="{{old('email',$data->email)}}" class="form-control shadow-none" autocomplete="off">
                                            <label for="email" class=" form-label">Email</label>

                                        </div>
                                        
                                        @error('email')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">
                                          
                                            <input type="number" id="phone" name="phone"  value="{{old('phone',$data->phone)}}"class="form-control shadow-none" autocomplete="false">
                                            <label for="phone" class="form-label">Phone</label>

                                        </div>
                                        
                                        @error('phone')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                   
                                                    <input type="text" id="city"name="city" value="{{old('city',$data->city)}}" class="form-control shadow-none"autocomplete="off">
                                                    <label for="city" class=" form-label">City</label>

                                                </div>
                                            </div>

                                            @error('city')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                            <div class="col-6">
                                            <div class="form-group mt-3 mb-0 pb-0">
                                           
                                           <label for="experience" class="">Experience</label>
                                               <select name="experience" id="experience">
                                                   <option value="Beginner">Beginner</option>
                                                   <option value="Intermediate">Intermediate</option>
                                                   <option value="Expert">Expert</option>
                                                   <option value="Intern">Intern</option>
                                               </select>
                                              
                                           </div>
                                           
                                           @error('experience')
                                              <div class="alert alert-danger">{{$message}}</div>
                                           @enderror 
                                               
                                            </div>
                                        </div>

                                        @error('country')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">
                                                   
                                                    <input type="text" id="address" name="address" value="{{old('address',$data->address)}}" class="form-control shadow-none "autocomplete="off">
                                                    <label for="address" class="form-label">Address</label>
                                                </div>
                                       
                                                @error('address')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                       
                                        <div class="form-group">
                                           
                                            <input type="number" id="nid" name="nid"  value="{{old('nid',$data->nid)}}" class="form-control shadow-none "autocomplete="off">
                                            <label for="nid" class="form-label">Nid</label>
                                        </div>

                                        @error('nid')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">
                                           
                                            <input type="number" id="salary" name="salary" value="{{old('salary',$data->salary)}}" class="form-control shadow-none" autocomplete="off">
                                            <label for="salary" class=" form-label">Salary</label>
                                        </div>
                                        
                                        @error('salary')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">

                                        <label class="" for="image">Image</label> 
                                          <input type="file" name="image" id="image"  value="{{old('image',$data->image)}}"class="form-control-file" autocomplete="off"/>
                                          
                                
                                          <div class="col-6">
                                                    <img id="preview-image" src=""
                                                     alt="preview image" style="max-height: 250px;max-width:500px; display:none">
                                            </div>
                                           
                                        </div>
                                        
                                        @error('image')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                       @if($data->name!="")
                                       <input type="hidden" value="{{$data->id}}" name="updateId" />
                                       <input type="hidden" value="{{$data->image}}" name="image" />
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
    $('document').ready(function(e){
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) =>{
                $('#preview-image').css("display",'block');
                $('#preview-image').attr('src',e.target.result);
            }
            reader.readAsDataURL(this.files[0]); 
       
        })
    })
</script>
@endsection