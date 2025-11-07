<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chain_Region extends Model
{
    use HasFactory;
	protected $table = 'chain_region';
    protected $fillable = ['chain_id','region_id'];
	public $timestamps = false;
}
