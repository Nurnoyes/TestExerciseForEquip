<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index() {
        $groups = Groups::all();
        return response()->json($groups);
    } #возвращаем список всех продуктов, понадобилось бы для главного экрана
    #метод show вызывает группы с необходимым нам id_parent
    #нужен для реализации вложенных групп
    public function show($id) {
        try {
            $groupsWithParent = DB::table('groups')
                ->where('id_parent', '=', $id)
                ->get(); #находим потомков папки потомков для отображения во вложении
            return response()->json($groupsWithParent);
        }
        catch(ModelNotFoundException $e) {
            return $e;
        }
        catch(\Exception $e) {
            return $e;
        }
    }
}
