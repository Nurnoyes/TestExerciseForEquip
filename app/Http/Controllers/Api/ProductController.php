<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index() {
        $products = Products::all()
        ->join('prices', 'products.id', '=', 'prices.id_product');
        return response()->json($products);
    } #список всех товаров в магазине для главного экрана

    public function show($id) {
        try {
            $productsUnderParent = DB::table('products')
                ->join('prices', 'products.id', '=', 'prices.id_product')
            ->where('products.id_group', '=', $id)
                ->paginate(5); #получаем список товаров для группы  id с пагинацией
            $countProductsUnderParent = count($productsUnderParent);
            return response()->json($productsUnderParent);

        }
        catch(ModelNotFoundException $e) {
            return response()->json(["message" => "Group not found"], 404);
        }
        catch(\Exception $e) {
            return response()->json(["message" => "Group not found"], 500);
        }
    }
    public function sorting($id, $sorting, $ordering) {
        try {
            $productsUnderParent = DB::table('products')
                ->join('prices', 'products.id', '=', 'prices.id_product')
                ->where('products.id_group', '=', $id)->orderBy($sorting, $ordering)->paginate(5);//->get()->paginate(20);
            $countProductsUnderParent = count($productsUnderParent); #тот же список товаров но с сортировкой  по цене и названию


            return response()->json($productsUnderParent);
        }
        catch(ModelNotFoundException $e) {
            return response()->json(["message" => "Group not found"], 404);
        }
        catch(\Exception $e) {
            return response()->json(["message" => "Group not found"], 500);
        }
    }
}
