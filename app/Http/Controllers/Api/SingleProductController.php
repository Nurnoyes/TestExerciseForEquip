<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleProductController extends Controller
{
    public function show($id) { #получаем товар из списка с названием, ценой и папкой родителя(пригдоилось бы для хлебных крошек
        $product = DB::table('prices')
            ->join('products', 'prices.id_product', '=', 'products.id')
            ->where('prices.id_product', '=', $id)->first();
        return response()->json($product);
    }
}
