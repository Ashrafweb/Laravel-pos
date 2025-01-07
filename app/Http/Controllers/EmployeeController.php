<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{

    public function add()
    {
      $data = (object)[
          'name' => '',
          'salary'=>'',
          'email' => '',
          'phone'=>'',
          'city'=>'',
          'address'=>'',
          'country'=>'',
          'nid'=>'',
          'experience'=>'',
          'image'=>''
      ];
      $result = collect(["data"=>$data]);

       
        return view('addemployees',$result);
    }

    public function create(REQUEST $request)
    {
        $request->validate([
            'name'=> 'required',
            'email'=> "email|required|unique:customers,email",
            'address'=>'required',
            'phone'=>"required|max:11|min:11",
            'city'=>'required',
            'experience'=>'required',
            'salary'=>'required',
            'nid'=>"required",
            // 'image'=>'required|mimes:jpg,jpeg,png',
            
    
        ]);

        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
        };

        if($request->updateId)
        {
           $image_name = $request->image ;
           
        };

        $arr = [
            'name'=> $request->name ,
            'email'=> $request->email ,
            'address'=> $request->address ,
            'phone'=> $request->phone ,
            'city'=> $request->city ,  
            'experience'=>$request->experience ,   
            'salary'=>$request->salary ,   
            'image'=> $image_name,   
            'nid'=> $request->nid,
            'status'=> 1
            ];
      

        if($request->updateId)
        {
        $update = DB::table('employees')->where(['id'=>$request->updateId])->update($arr);
            if($update)
            {
                return back()->with('success',"Employee Updated Successfully");
            }
            else
            {
                $request->remember ;
                return back()->with('failure',"No changes made");
            };
        }
        else
        {
            $insert = DB::table('employees')->insert($arr);
            if($insert)
            {
                return back()->with('success',"Employee Added Successfully");
            }
            else
            {
                $request->remember ;
                return back()->with('failure',"Failed To Add Employee");
            };
        };       
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        $result['employees'] = DB::table('employees')->get();

        return view('employees',$result);
    }

    public function edit($id)
    {
       $result['data'] = DB::table('employees')->where(['id'=>$id])->first();
      // dd($result);
       return view('addemployees',$result);
    }

    public function update(Request $request)
    {
        
    }
    public function destroy($id)
    {
        if(DB::table('employees')->where(['id'=>$id])->delete())
        {
            return back()->with('success',"Employee Deleted Successfully");
        }else
        {
            return back()->with('failure',"Failed To Remove Employee");
        }
    }
}
