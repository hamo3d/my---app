<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;



    //api
    protected $appends = [

        'products_price'
    ];

    public function productsPrice() : Attribute{
        return new Attribute(get: fn() => $this->products()->sum('price'));
    }

    /////////////////////////////////////////////////////////////////////////////

    //web


    public function visibltiey () : Attribute{

        return new Attribute(get:fn() => $this->active ? 'Visible' : 'Hidden' );
    }
     // العلاقة


    public function Products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];



    protected $fillable = [
        'name',
        'info',
        'visible'
    ];


    protected $casts = [

    'visible' => 'boolean',

    ];


}
