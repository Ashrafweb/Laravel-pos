@extends('layout.app')
@section('content')

<div class="container-fluid">
                @if(session('message'))
                       <div class="alert alert-danger p-3 text-center fw-bold"> {{session('message')}} </div>
                @endif
       <div class="title text-left bg-light">
          <h4 class="">Employees</h4>
       </div>
        <div class="card shadow mb-4">
             <div class="card-body">
                      
             <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Emp</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Experience</th>
                      <th>Salary</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($employees as $employee)
                    <tr>
                      <td> <img src="{{asset('storage/media/'.$employee->image)}}" width="40px" height="40px"/></td>
                      <td>{{$employee->name}}</td>
                      <td>{{$employee->email}}</td>
                      <td>{{$employee->phone}}</td>
                      <td>{{$employee->Experience}}</td>
                      <td>{{$employee->salary}}</td>
                      @if($employee->status===1)
                      <td><span class="badge badge-success fw-bold text-uppercase">Active</span></td>  
                      @else 
                      <td><span class="badge badge-danger fw-bold text-uppercase">Inactive</span></td>  
                      @endif
                      <td>
                          <a href="{{url('employees/edit/'.$employee->id)}}"><button class="btn btn-light py-0  shadow-none"><i class="fa fa-pen text-primary"></i></button></a>
                          <a href="{{url('employees/delete/'.$employee->id)}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light py-0 shadow-none"><i class="fa fa-trash text-danger"></i></button></a>
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







@endsection