<?php

namespace app\index\model;

use think\Model;

class Category extends Model
{
    protected $field = true;

//    获取分类的数据的接口
    public function getCategoryApi(){
        return Category::all();
    }
}
