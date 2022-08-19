<?php
namespace App\Models;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class
Food extends Model
{
    use DefaultDatetimeFormat;
    //table name

//    public $timestamps=false;
    protected $table = 'foods';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'stars',
        'people',
        'selected_people',
        'img',
        'location',
//        'created_at',
//        'updated_at',
        'order',
        'type_id'
    ];
    public function FoodType(){
        return $this->hasOne(FoodType::class, 'id', 'type_id');
    }
    public function getRecommended(){
        return $this->where(['is_recommend'=>1])->orderBy('id', 'DESC')->limit(3)->get();
    }
    public function getPopularFood(){
        return $this->where(['type_id'=>2])->orderBy('id', 'DESC')->limit(3)->get();
    }
    public function getUnRecommended(){
        return $this->where(['is_recommend'=>0])->orderBy('id', 'DESC')->limit(3)->get();
    }

    public function getRecent(){
        return $this->limit(5)->orderBy('id', 'DESC')->get();
    }



}
