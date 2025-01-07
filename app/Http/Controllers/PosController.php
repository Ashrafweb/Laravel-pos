<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    public function index()
    {
        $result['products'] = DB::table('products')
                              ->where(['status'=>1])
                              ->get() ;
        
        $result['pos_data'] = DB::table('pos_cart')
                              ->get() ;   

        $result['customers'] = DB::table('customers')->where(['status'=>1])->get();

        return view('pos',$result);
    }

    public function add_to_cart(REQUEST $request)
    {
        if(isset($request->id))
        
        {
            $arr = [
                'product_id'=> $request->id,
                'name'=>$request->name,
                'price'=>$request->price,
                'image'=>$request->image,
                'qty'=>1
            ];

            $insert = DB::table('pos_cart')->insert($arr);

            if($insert)
            {
                echo "success";
            }
            else
            {
                echo "failed";
            }

        }

    }

    public function remove_from_cart(REQUEST $request)
    {
        if(isset($request->pro_id))
        
        {
            DB::table('pos_cart')
            ->where(['product_id'=>$request->pro_id])
            ->delete();
            
            echo "success";
        }

        else
        {
            echo "failed";
        }
    }

    public function update_qty(REQUEST $request)
    {
        if(isset($request->pro_id))
        {
            $update = DB::table('pos_cart')->where(['product_id'=>$request->pro_id])->update(['qty'=>$request->qty]);

            if($update)
            {
                echo "success";
            }  
              else
            {
                echo "Failed";
            }

        }
        else
        {
            echo "Error";
        }
    }

    public function total(REQUEST $request)
    {
        $cart_item = Db::table('pos_cart')->get();
        $total = 0;

        foreach($cart_item as $product)
        {
            $total = $total + $product->qty * $product->price ;  
        }
        echo  $total ;
    }

    public function sellcart(REQUEST $request)
    {
        if($request->customer > 0)
        {
            $result['cart_products'] = DB::table('pos_cart')->get();

            $result['customer'] = DB::table('customers')->where(['id'=>$request->customer])->first();

            $total = 0;

            foreach( $result['cart_products'] as $product)
            {
                $total = $total + $product->qty * $product->price ;  
            }
            
            $result['total'] = $total ;
            $result['order_id'] = rand(11111111,99999999);
            return view('pos.invoice',$result);
        } 
        
        else

        {
            return back()->with('message',"Failed To Proceed");
        }
        
    }

    public function invoice(REQUEST $request)
    {
        if(isset($_POST))
        {
            $request->validate([
                'customer_id'=>'required',
                'total'=>'required',
                'payment'=>'required',
                'paid'=>'required',
                'due'=>'required',
                'order_id'=>'required'
            ]);

            $arr = [
                'order_unique_id'=>$request->order_id,
                'customer_id'=>$request->customer_id,
                'total_price'=>$request->total,
                'payment'=>$request->payment,
                'paid'=>$request->paid,
                'due'=>$request->due,
                'order_status'=>'pending',
                'customer_name'=>$request->customer_name

            ];

            $insert =  DB::table('orders')->insert($arr);

            $cart_items = DB::table('pos_cart')->get();

            foreach($cart_items as $item)
            {
                $product = [
                    'order_id' => $request->order_id,
                    'name'=>$item->name,
                    'product_id'=>$item->product_id,
                    'unit_price'=>$item->price,
                    'qty'=>$item->qty
                ];

                $detail = DB::table('order_details')->insert($product);
            }

            if($insert)
            {
                return redirect('orders/pending');
            }else
            {
                return back()->with('message',"Failed To Confirm Order.");
            }


        }
    }

   
  
}
