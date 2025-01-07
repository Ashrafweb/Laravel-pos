<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;

class ProductController extends Controller
{
   
    public function add()
    {
        $result['categories']  = DB::table('categories')->where(['status'=>1])->get();   
        $result['supplier']  = DB::table('suppliers')->get();
        $data = (object)[
            'name' => '',
            'code'=>'',
            'godaun' => '',
            'category'=>'',
            'supplier'=>'',
            'Product'=>'',
            'buying_date'=>'',
            'expire_date'=>'',
            'description'=>'',
            'buying_price'=>'',
            'selling_price'=>'',
            'product_route'=>'',
            'image'=>''
        ];

        $result['blank_data'] = collect(["data"=>$data]);
       // dd($result['blank_data']['data']);
        return view('add_product',$result);
    }

   

    public function create(REQUEST $request)
    {
     //  
    }

    public function store(Request $request)
    {
      
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'godaun'=>'required',
            'category_id'=>'required',
            'Product_id'=>'required',
            'buying_date'=>'required',
            'expire_date'=>'required',
            'description'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'product_route'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png' ,
        ]);
        
        
        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
        };



        $arr = [     
            'name' => $request->name,
            'code'=> $request->code,
            'godaun' => $request->godaun,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'category_id'=> $request->category_id,
            'Product_id'=> $request->Product_id,
            'buying_price'=> $request->buying_price,
            'selling_price'=> $request->selling_price,
            'description' => $request->description,
            'Product_route'=>$request->product_route,
            'image'       => $image_name,      
               
            ];


            if($request->updateId)
            {
                $update = Product::where(['id'=>$request->updateId])->update($arr);
                if($update)
                {
                    return back()->with('success',"Product Updated Successfully");
                }
                else
                {
                    $request->remember ;
                    return back()->with('failure',"No changes made");
                };
            }
            else
            {
                $insert = Product::create($arr);
                if($insert)
                {
                    return back()->with('success',"Product Added Successfully");
                }
                else
                {
                    $request->remember ;
                    return back()->with('failure',"Failed To Add Product");
                };
            };
                



    }

    public function status(Request $request)
    {
        if($request->id > 0 && $request->action!=""){
           if($request->action==="activate"){
               Product::where(['id'=>$request->id])->update(['status'=>1]);
               echo "success";
           }elseif($request->action==="deactivate"){
            Product::where(['id'=>$request->id])->update(['status'=>0]);
            echo "success";
           }else{
               echo "failed";
           }
        }else{
            echo "failed";
        }
    }

    public function show(Product $Product)
    {
        $result['products'] = Product::all();
        foreach($result['products'] as $product){

            $product->category_id =  Category::where(['id'=>$product->category_id])->value('name');
        }
       // dd($result);
        return view('products',$result);
    }

    public function edit(Product $Product,$id)
    {
        $result['blank_data']['data'] = Product::where(['id'=>$id])->first();
        $result['categories']  = DB::table('categories')->where(['status'=>1])->get();   
        $result['supplier']  = DB::table('suppliers')->get();

        return view('add_product',$result);
    }

   
    public function update(Request $request, Product $Product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Product::where(['id'=>$id])->delete())
        {
            return back()->with('success',"Product Deleted Successfully");
        }else
        {
            return back()->with('failure',"Failed To Remove Product");
        }
    }

    public function fileExport() 
    {
        return Excel::download(new ProductsExport, 'users-collection.xlsx');
    }   

    public function fileImport(Request $request) 
    {
        Excel::import(new ProductsImport, $request->file('file')->store('temp'));
        return back();
    }
}
