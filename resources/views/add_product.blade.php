@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
    @if($blank_data['data']->name!=="") 
      <div class="mr-3"><a href="{{url('/products')}}"><button class="btn btn-primary">&laquo; Back
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
                                        <strong class="text-lg">Product</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form' method="post" action="{{url('products/create')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                           
                                            <input type="text" id="name" name="name"  class="shadow-none form-control" value="{{old('name',$blank_data['data']->name)}}" autocomplete="false">
                                            <label for="name" class="form-label">Name</label>
                                        </div>
                                        @error('name')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror 
                                        <div class="form-group">
                                           
                                            <input type="text" id="code" name="code" class="form-control shadow-none" autocomplete="off" value="{{old('code',$blank_data['data']->code)}}">
                                            <label for="code" class=" form-label">Code</label>

                                        </div>
                                        @error('code')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        <div class="form-group">
                                           
                                            <input type="text" id="godaun" name="godaun" class="form-control shadow-none" autocomplete="false" value="{{old('godaun',$blank_data['data']->godaun)}}">
                                            <label for="godaun" class="form-label">Godaun</label>

                                        </div>
                                        @error('godaun')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        <div class="form-group">
                                           
                                            <input type="text" id="product_route" name="product_route" class="form-control shadow-none" autocomplete="false" value="{{old('product_route',$blank_data['data']->product_route)}}">
                                            <label for="product_route" class="form-label">Product Route</label>

                                        </div>
                                        @error('product_route')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                    <input type="date" id="buying_date" name="buying_date"  class="form-control shadow-none"autocomplete="off" value="{{old('buying_date',$blank_data['data']->buying_date)}}">
                                                    <label for="buying_date" class="label-date">Buying_date</label>
                                            @error('buying_date')
                                               <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                                </div>
                                            </div>
                                          
                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                   <input type="date" id="expire_date" name="expire_date"  class="form-control shadow-none"autocomplete="off" value="{{old('expire_date',$blank_data['data']->expire_date)}}">
                                                   <label for="expire_date" class="label-date">Expire_date</label>
                                            @error('expire_date')
                                               <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                                </div>                                              
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                    <input type="number" id="buying_price" name="buying_price"  class="form-control shadow-none"autocomplete="off" value="{{old('buying_price',$blank_data['data']->buying_price)}}">
                                                    <label for="buying_price" class="form-label">Buying Price</label>
                                        @error('buying_price')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                                </div>
                                            </div>
                                        
                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                   <input type="number" id="selling_price" name="selling_price"  class="form-control shadow-none"autocomplete="off" value="{{old('selling_price',$blank_data['data']->selling_price)}}">
                                                   <label for="selling_price" class="form-label">Selling Price</label>
                                        @error('selling_price')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                                </div>                                             
                                            </div>
                                          
                                        </div>
                                        <div class="row"
                                        >
                                        <div class="col-6">
                                        <div class="form-group">
                                         <label for="category_id" class="">Category</label>
                                                 @if(isset($categories)) 
                                                 <select name="category_id" class="form-select" id="category_id" value="{{old('category',$blank_data['data']->category)}}">
                                                    <option value=''>Select Category</option>
                                                 @foreach($categories as $cat) 
                                                   
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                   
                                                 @endforeach   
                                                 </select>
                                                 @endif
                                                  
                                              </div>
                                       
                                          </div>
                                          @error('category_id')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror     
                                          <div class="col-6">
                                              <div class="form-group">
                                                  
                                                 <label for="supplier_id" class="">Supplier</label>
                                                 @if(isset($supplier)) 
                                                 <select name="supplier_id" class="form-select" id="supplier_id" value="{{old('supplier',$blank_data['data']->supplier)}}">
                                                    <option value=''>Select Supplier</option>
                                                    
                                                 @foreach($supplier as $supp) 
                                                                                                      
                                                    <option value="{{$supp->id}}">{{$supp->name}}</option>                                                 

                                                 @endforeach   
                                                 </select>
                                                 @endif   
                                        
                                              </div>
                                              @error('supplier_id')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror             
                                          </div>
                                      </div>

                                        <div class="form-group">
                                                  
                                                    <input type="textarea" id="description" name="description" class="form-control shadow-none "autocomplete="off" value="{{old('description',$blank_data['data']->description)}}">
                                                    <label for="description" class="form-label">Description</label>
                                                </div>
                                       
                                        @error('description')
                                           <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        <div class="form-group">

                                            <label class="" for="image">Image</label>  
                                            <input type="file" id="image" name="image" class="form-control-file" autocomplete="off" value="{{old('image',$blank_data['data']->image)}}" />
                                            @error('image')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror  

                                            <div class="col-6">
                                                    <img id="preview-image" src=""
                                                     alt="preview image" style="max-height: 250px;max-width:500px; display:none">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>

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