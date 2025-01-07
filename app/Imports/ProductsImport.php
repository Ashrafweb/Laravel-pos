<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
   
    public function model(array $row)
    {
        return new Product([
          
            'name' => $row[1],    
            'code' => $row[2],
            "qty"=>$row[3],
            'category_id'=>$row[4],
            'supplier_id'=>$row[5],
            'godaun'=>$row[6],
            'Product_Route'=>$row[7],
            'buying_date'=>$row[8],
            'expire_date'=>$row[9],
            'buying_price'=>$row[10],
            'selling_price'=>$row[11],
            'image'=>$row[12],
            'description'=>$row[13],
            'status'=>$row[14],
        ]);
    }
}
