<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        return view('add_customer',$result);
    }

    
    public function create(REQUEST $request)
    {
        $request->validate([
            'name'=> 'required|unique:customers,name,'.$request->updateId,
            'email'=> "email|required|unique:customers,email,".$request->updateId,
            'address'=>'required',
            'phone'=>"required|max:11|min:11",
            'city'=>'required',
    
        ]);

        $arr = [
            'name' => $request->name ,
            'email' => $request->email ,
            'address' => $request->address ,
            'phone' => $request->phone ,
            'city' => $request->city ,
            'company_name' => $request->company_name ,      
            'status'=> 1
            ];

            if($request->updateId)
            {
            $update = Customer::where(['id'=>$request->updateId])->update($arr);
                if($update)
                {
                    return back()->with('success',"Customer Updated Successfully");
                }
                else
                {
                    $request->remember ;
                    return back()->with('failure',"No changes made");
                };
            }
            else
            {
                $insert = Customer::create($arr);
                if($insert)
                {
                    return back()->with('success',"Customer Added Successfully");
                }
                else
                {
                    $request->remember ;
                    return back()->with('failure',"Failed To Add Customer");
                };
            };

    }

    public function status(Request $request)
    {
        if($request->id > 0 && $request->action!=""){
           if($request->action==="activate"){
               Customer::where(['id'=>$request->id])->update(['status'=>1]);
               echo "success";
           }elseif($request->action==="deactivate"){
            Customer::where(['id'=>$request->id])->update(['status'=>0]);
            echo "success";
           }else{
               echo "failed";
           }
        }else{
            echo "failed";
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $result['customers'] = Customer::all();

        return view('customers',$result);
    }

    public function edit(Customer $customer,$id)
    {
        $result['data'] = Customer::where(['id'=>$id])->first();
        return view('add_customer',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id)
    {
        if(Customer::where(['id'=>$id])->delete())
        {
            return back()->with('success',"Customer Deleted Successfully");
        }else
        {
            return back()->with('failure',"Failed To Remove Customer");
        }
    }
}
