@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
@if($data->name!=="") 
      <div class="mr-3"><a href="{{url('/categories')}}"><button class="btn btn-primary">Back
      </button></a></div>
    @endif
<div class="col-lg-6 my-3">
                @if(session('message'))
                       <div class="alert alert-success p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <strong class="text-lg">Category</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form' method="post" action="{{url('category/insert')}}">
                                            @csrf
                                        <div class="form-group">
                                           
                                            <input type="text" id="name" name="name"  class="shadow-none form-control" autocomplete="false" value="{{old('name',$data->name)}}">
                                            <label for="name" class="form-label">Name</label>
                                        </div>

                                        @error('name')

                                           <div class="alert alert-danger">{{$message}}</div>                 

                                        @enderror

                                        <div class="form-group">
                                           
                                            <input type="text" id="slug" name="slug" class="form-control shadow-none" autocomplete="false"  value="{{old('slug',$data->cat_slug)}}">
                                            <label for="slug" class=" form-label">Category Slug/Code</label>
                                        </div>

                                        @error('slug')

                                        <div class="alert alert-danger">{{$message}}</div>                 

                                        @enderror

                                        <!-- <div class="form-group">

                                        <label class="" for="image">Image</label> 
                                          <input type="file" id="image" name="image" class="form-control-file" autocomplete="off"  value="{{old('image')}}"/>
                                          
                                        @error('image')

                                        <div class="alert alert-danger">{{$message}}</div>    

                                        @enderror     
                                        </div>
                                       -->
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
@endsection