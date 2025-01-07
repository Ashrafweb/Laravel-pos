<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App ;
use PDF ;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

  
    public function pending()
    {
        $result['orders'] = Order::where('order_status','pending')->get();
        return view('pending',$result);
    }

    public function success_orders()
    {
        $result['orders'] = Order::where('order_status','success')->get();
        return view('success_orders',$result);
    }
   
    public function verify_order(REQUEST $request,$id)
    {
        if($id>0)
        {
            $result['products'] = DB::table('order_details')
                                  ->where(['order_id'=>$id])
                                  ->get();

            $result['customer_id'] = DB::table('orders')->where(['order_unique_id'=>$id])->first();
            $result['customer'] = DB::table('customers')->where(['id'=> $result['customer_id']->customer_id])->first();          
        
            $total = 0;
    
            foreach( $result['products'] as $product)
            {
                $total = $total + $product->qty * $product->unit_price ;  
            }
            
            $result['total'] = $total ;

            $result['order_id'] = $id ;

           
               
          
                return view('verify_order',$result);
            
        }
    }

    
    public function success(REQUEST $request)
    {
        if($request->order_id>0)
        {
           DB::table('orders')->where(['order_unique_id'=>$request->order_id])->update(['order_status'=>'success']);
           
           return back();
        }
    }


    public function download_pdf(REQUEST $request,$id)
    {
        if($id>0)
        {
            $result['products'] = DB::table('order_details')
                                  ->where(['order_id'=>$id])
                                  ->get();

            $result['customer_id'] = DB::table('orders')->where(['order_unique_id'=>$id])->first();
            $result['customer'] = DB::table('customers')->where(['id'=> $result['customer_id']->customer_id])->first();          
        
            $total = 0;
    
            foreach( $result['products'] as $product)
            {
                $total = $total + $product->qty * $product->unit_price ;  
            }
            
            $result['total'] = $total ;

            $result['order_id'] = $id ;

              $pdf = PDF::loadView('invoicepdf',$result);
              return $pdf->download("Invoice.pdf");
           //return view('invoicepdf',$result);
        }

    }

    public function show(){
        $result['orders'] = Order::all();
        return view('orders',$result);
    }
}
