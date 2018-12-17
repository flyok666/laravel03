<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //获取该学生对应的学校  1对多 （反向）
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
