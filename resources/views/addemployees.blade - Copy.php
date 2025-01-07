@extends('layout.app')
@section('content')

<div class="row d-flex justify-content-center">
<div class="col-lg-8 my-3">
                                <div class="card border-0">
                                    <div class="card-header">
                                        <strong>Employee</strong>
                                        <small> Form</small>
                                    </div>
                                    <div class="card-body card-block rounded">
                                        <form class='styled_form' method="post" action="">
                                        <div class="form-group">
                                           
                                            <input type="text" id="name"  name="name" class="shadow-none form-control" autocomplete="false">
                                            <label for="name" class="form-label">Name</label>
                                        </div>
                                        <div class="form-group">
                                           
                                            <input type="email" id="email" name="email" class="form-control shadow-none" autocomplete="off">
                                            <label for="email" class=" form-label">Email</label>

                                        </div>
                                        <div class="form-group">
                                          
                                            <input type="number" id="phone" name="phone" class="form-control shadow-none" autocomplete="false">
                                            <label for="phone" class="form-label">Phone</label>

                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                   
                                                    <input type="text" id="city"name="city"  class="form-control shadow-none"autocomplete="off">
                                                    <label for="city" class=" form-label">City</label>

                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                  
                                                   <input type="text" id="country" name="country"  class="form-control shadow-none"autocomplete="off">
                                                   <label for="country" class=" form-label">Country</label>

                                                </div>
                                               
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                   
                                                    <input type="text" id="address" name="address" class="form-control shadow-none "autocomplete="off">
                                                    <label for="address" class="form-label">Address</label>
                                                </div>
                                       

                                        <div class="form-group">
                                           
                                            <input type="number" id="nid" name="nid"  class="form-control shadow-none "autocomplete="off">
                                            <label for="nid" class="form-label">Nid</label>
                                        </div>

                                        <div class="form-group">
                                           
                                            <input type="number" id="salary" name="salary" class="form-control shadow-none" autocomplete="off">
                                            <label for="salary" class=" form-label">Salary</label>
                                        </div>
                                        <div class="form-group">

                                          <input type="file" name="image" id="image" class="form-control-file" autocomplete="off"/>
                                          
                                          <label class="" for="image">Image</label> 
                                           
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
</div>   
@endsection