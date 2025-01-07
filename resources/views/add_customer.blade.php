@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
@if($data->name!=="") 
      <div class="mr-3"><a href="{{url('/customers')}}"><button class="btn btn-success">Back
      </button></a></div>
    @endif
<div class="col-lg-6 my-3">


                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                            @if(session('failure'))
                                <div class="alert alert-danger">{{session('failure')}}</div>
                            @endif

                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <strong class="text-lg text-success">Customer</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form' method="post" action="{{url('customer/insert')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" id="name" name="name"  class="shadow-none form-control" autocomplete="false"  value="{{old('name',$data->name)}}">
                                            <label for="name" class="form-label">Name</label>
                                        </div>

                                        @error('name')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 

                                        <div class="form-group">
                                           
                                            <input type="email" id="email" name="email" class="form-control shadow-none" autocomplete="off" value="{{old('email',$data->email)}}" >
                                            <label for="email" class=" form-label">Email</label>

                                        </div>

                                        @error('email')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        
                                        <div class="form-group">
                                           
                                            <input type="number" id="phone" name="phone" class="form-control shadow-none" autocomplete="false"  value="{{old('phone',$data->phone)}}">
                                            <label for="phone" class="form-label">Phone</label>

                                        </div>

                                        @error('phone')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 

                                        <div class="row">

                                            <div class="col-6">
                                               <div class="form-group">
                                                  
                                                    <input type="text" id="address" name="address" class="form-control shadow-none "autocomplete="off"  value="{{old('address',$data->address)}}">
                                                    <label for="address" class="form-label">Address</label>

                                                </div>
                                                @error('address')
                                                   <div class="alert alert-danger">{{$message}}</div>
                                                @enderror 

                                            </div>    

                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                    <input type="text" id="city" name="city" class="form-control shadow-none "autocomplete="off"  value="{{old('city',$data->city)}}">
                                                    <label for="city" class="form-label">City</label>
                                                </div>   

                                                @error('city')
                                                     <div class="alert alert-danger">{{$message}}</div>
                                                @enderror                 

                                            </div>

                                           

                                         </div>
                                         
                                                <div class="form-group">
                                                  
                                                    <input type="text" id="company_name" name="company_name" class="form-control shadow-none "autocomplete="off"  value="{{old('company_name',$data->company_name)}}">
                                                    <label for="company_name" class="form-label">Company(optional)</label>
                                                </div>   

                                                @error('company_name')
                                                      <div class="alert alert-danger">{{$message}}</div>
                                                @enderror                                
                                    
                                      
                                       

                                      
                                                @if($data->name!="")
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
@endsection