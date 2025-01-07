@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
@if($data->name!=="") 
      <div class="mr-3"><a href="{{url('/suppliers')}}"><button class="btn btn-success">&laquo;Back
      </button></a></div>
    @endif

<div class="col-lg-6 my-3">
                @if(session('message'))
                       <div class="alert alert-success p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <strong class="text-lg">Supplier</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form' method="post" action="{{url('supplier/insert')}}" enctype="multipart/form-data">
                                            @csrf
                                        <div class="form-group">
                                          
                                            <input type="text" id="name" name="name" class="shadow-none form-control" autocomplete="false" value="{{old('name',$data->name)}}">
                                            <label for="name" class="form-label">Name</label>

                                        </div>
                                        @error('name')
                                           <div class="alert alert-danger">    {{$message}}    </div>
                                        @enderror
                                        <div class="form-group">
                                          
                                            <input type="email" id="email" name="email" class="form-control shadow-none" autocomplete="off"  value="{{old('email',$data->email)}}">
                                            <label for="email" class=" form-label">Email</label>
                                        </div>
                                        @error('email')
                                           <div class="alert alert-danger">    {{$message}}    </div>
                                        @enderror

                                        <div class="form-group">
                                           
                                            <input type="number" id="phone" name="phone" class="form-control shadow-none" autocomplete="false"  value="{{old('phone',$data->phone)}}">
                                            <label for="phone" class="form-label">Phone</label>
                                        </div>
                                        @error('phone')
                                           <div class="alert alert-danger">    {{$message}}    </div>
                                        @enderror

                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                   
                                                    <input type="text" id="city"name="city"  class="form-control shadow-none"autocomplete="off"  value="{{old('city',$data->city)}}">
                                                    <label for="city" class=" form-label">City</label>
                                                    
                                            @error('city')
                                           <div class="alert alert-danger">    {{$message}}    </div>
                                            @enderror
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                   
                                                    <input type="text" id="address" name="address" class="form-control shadow-none "autocomplete="off"  value="{{old('address',$data->address)}}">
                                                    <label for="address" class="form-label">Address</label>
                                                    @error('address')
                                            <div class="alert alert-danger">    {{$message}}    </div>
                                            @enderror
                                                </div>
                                           
                                            </div>
                                        </div>

                                
                                       

                                        <div class="form-group">
                                           
                                            <input type="text" id="company_name" name="company_name"  class="form-control shadow-none "autocomplete="off"  value="{{old('company_name',$data->company_name)}}">
                                            <label for="company_name" class="form-label">Company Name(optional)</label>
                                        </div>

                                     
                                        <div class="form-group">

                                          <label class="" for="image">Image(optional)</label> 
                                          <input type="file" id="image" name = "image" class="form-control-file" autocomplete="off"  value="{{old('image',$data->image)}}"/>
                                          
                                                @error('image')
                                                <div class="alert alert-danger">    {{$message}}    </div>
                                                @enderror
                                        </div>
                                        @if($data->name!=="")
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
@endsection