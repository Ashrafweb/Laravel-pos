<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            'cat_slug'=>'',
            
        ];
        $result = collect(["data"=>$data]);
          
        return view('add_category',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(REQUEST $request)
    {
        $request->validate([
            'name' => 'required',
            'slug'=>'required|unique:categories,cat_slug',
            
        ]);

        $arr = [
            'name' =>$request->name,
            'cat_slug'=>$request->slug,
            'status'=>1
        ];
        
        if($request->updateId)
        {
        $update = Category::where(['id'=>$request->updateId])->update($arr);
            if($update)
            {
                return back()->with('success',"Category Updated Successfully");
            }
            else
            {
                $request->remember ;
                return back()->with('failure',"No changes made");
            };
        }
        else
        {
            $insert = Category::create($arr);
            if($insert)
            {
                return back()->with('success',"Category Added Successfully");
            }
            else
            {
                $request->remember ;
                return back()->with('failure',"Failed To Add Category");
            };
        };
    
    }

  
    public function store(Request $request)
    {
        //
    }

   
    
    public function status(Request $request)
    {
        if($request->id > 0 && $request->action!=""){
           if($request->action==="activate"){
               Category::where(['id'=>$request->id])->update(['status'=>1]);
               echo "success";
           }elseif($request->action==="deactivate"){
            Category::where(['id'=>$request->id])->update(['status'=>0]);
            echo "success";
           }else{
               echo "failed";
           }
        }else{
            echo "failed";
        }
    }
    public function show(Category $Category)
    {
        $result['categories'] = Category::all();

        return view('category',$result);
    }

    public function edit(Category $Category,$id)
    {
        $result['data'] = Category::where(['id'=>$id])->first();
        return view('add_category',$result);
    }

  
    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $Category,$id)
    {
        if(Category::where(['id'=>$id])->delete())
        {
            return back()->with('success',"Category Deleted Successfully");
        }else
        {
            return back()->with('failure',"Failed To Remove Category");
        }
    }

}
