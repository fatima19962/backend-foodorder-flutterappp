<?php
namespace App\Models;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{



//    public $timestamps=false;

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
    //
    use DefaultDatetimeFormat;
    use ModelTree;
    //table name
    protected $table = 'food_types';

    public function getList(){
        return $this->get();
    }
}
