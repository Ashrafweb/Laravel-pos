<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data = (object)[
            'name' => '',
            'email' => '',
            'phone'=>'',
            'city'=>'',
            'address'=>'',
            'country'=>'',
            'company_name'=>'',
            'image'=>''
        ];
        $result = collect(["data"=>$data]);
          
        return view('add_supplier',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(REQUEST $request)
    {
       if($request->updateId){
        $request->validate([
            'name'=> 'required|unique:suppliers,name,'.$request->updateId,
            'email'=> "email|required|unique:suppliers,email,".$request->updateId,
            'address'=>'required',
            'phone'=>"required|max:11|min:11",
            'city'=>'required',
            'company_name'=>'required',
            //'image'=>'mimes:jpg,jpeg,png',
        ]);
        $image_name = $request->image ;
       }else{
        $request->validate([
            'name'=> 'required|unique:suppliers,name',
            'email'=> "email|required|unique:suppliers,email",
            'address'=>'required',
            'phone'=>"required|max:11|min:11",
            'city'=>'required',
            'company_name'=>'required',
            //'image'=>'mimes:jpg,jpeg,png',
        ]);
       }



        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
          };
       
       
           
            $arr = [
            'name' => $request->name ,
            'email' => $request->email ,
            'address' => $request->address ,
            'phone' => $request->phone ,
            'city' => $request->city ,
            'company_name' => $request->company_name ,
            'image' => $image_name,    
            'status'=>1,  
            ];

          

  

   if($request->updateId)
   {
       $update = Supplier::where(['id'=>$request->updateId])->update($arr);
       if($update)
       {
           return back()->with('success',"Supplier Updated Successfully");
       }
       else
       {
           $request->remember ;
           return back()->with('failure',"No changes made");
       };
   }
   else
   {
       $insert = Supplier::create($arr);
       if($insert)
       {
           return back()->with('success',"Supplier Added Successfully");
       }
       else
       {
           $request->remember ;
           return back()->with('failure',"Failed To Add Supplier");
       };
   };
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        if($request->id > 0 && $request->action!=""){
           if($request->action==="activate"){
               Supplier::where(['id'=>$request->id])->update(['status'=>1]);
               echo "success";
           }elseif($request->action==="deactivate"){
            Supplier::where(['id'=>$request->id])->update(['status'=>0]);
            echo "success";
           }else{
               echo "failed";
           }
        }else{
            echo "failed";
        }
    }

    public function show(Supplier $Supplier)
    {
        $result['suppliers'] = Supplier::all();

        return view('suppliers',$result);
    }

    public function edit(Supplier $Supplier,$id)
    {
        $result['data'] = Supplier::where(['id'=>$id])->first();
        return view('add_supplier',$result);
    }

   
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Supplier::where(['id'=>$id])->delete())
        {
            return back()->with('success',"Supplier Deleted Successfully");
        }else
        {
            return back()->with('failure',"Failed To Remove Supplier");
        }
    }
}
