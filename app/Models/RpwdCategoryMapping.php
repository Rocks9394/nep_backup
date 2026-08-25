<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpwdCategoryMapping extends Model
{
    use HasFactory;

     protected $table = 'pwd_category_test_mapping';


    public function testCategory()
    {
        return $this->belongsTo(TestCategoryMaster::class, 'TestCategoryId', 'TestCategoryID');
    }

    public function testType()
    {
        return $this->belongsTo(TestTypeMaster::class, 'TestTypeMasterID', 'TestTypeID');
    }

}
