<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;

class VariationController extends Controller
{
    public function show()
    {
        $result['variations'] = Variation::all();

        return view('variations',$result);
    }

    public function add()
    {
        $data = (object)[
            "name"=>'',
            
        ];

        $result = collect(['data'=>$data]);
       return view('addVariation',$result);
    }

    public function store(REQUEST $request)
    {
        $request->validate([
            "name" => 'required|unique:variations,name',
            'variation'=>'required'
        ]);
        
        $var_id = rand(11111,99999);

        $variations = $request->variation;

        $var_arr = [
            'name'=>$request->name,
            'variation_id'=>$var_id,
            'status'=>1
        ];

        if(Variation::create($var_arr))
        {
             foreach($variations as $variation){
                 $arr = [
                     'variation' => $variation,
                     'variation_id'=>$var_id,
                 ];
              $insert = DB::table('variation_value')->insert($arr);
              if($insert===false)
              {
                $request->remember;
                return back()->with('failed',"Failed To insert variation");
              }
             }
        }else{
            $request->remember;
            return back()->with('failed',"Failed To insert variation");
        }

        return back()->with('success',"Successfully added new variation");
        

    }
}
