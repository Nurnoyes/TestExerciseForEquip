<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';


    /*
     * Были предприняты попытки нахождения потомков у родительских папок, но я не справился
     * Не хватило времени для реализации, концепт был таков:
     */
    public function products(){
        $this->hasMany(Products::class);
    }
    public function parentFinder($id){
        $arrayofIDs = array(
            'id' => array()
        );
        $arrayofChildren = array(
            'id' => array()
        );
        $childs = $id;
        $groupsWithParent = DB::table('groups')
                ->where('id_parent', '=', $id)
                ->get('id'); #Находим потомков
        foreach($groupsWithParent as $group){ #сли потомки есть то добавляем их в два массива
            $arrayofIDs = array_push($arrayofIDs['id'], $group->id); #массив для запоминания всех потомков
            $arrayofChildren = array_push($arrayofChildren['id'], $group->id); #массив для цикла по потомкам
        }
        while($arrayofChildren != []){
                foreach($arrayofChildren as $group){ #для потомка находим его потомков
                    $groupsWithParent = DB::table('groups')
                        ->where('id_parent', '=', $group)
                        ->get('id');
                    $arrayofChildren = array_diff($arrayofChildren['id'], $group); #удаляем потомка из массива
                    foreach($groupsWithParent as $undergroup){
                        $arrayofIDs = array_push($arrayofIDs['id'], $undergroup->id); #обавляем потомка для массива потомков
                        $arrayofChildren = array_push($arrayofChildren['id'], $undergroup->id); #добавляем потомка для цикла
                    }

            }
        }
        return $arrayofIDs; #возвращаем массив всех потомков
    }



}
