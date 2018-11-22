<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;

class DynamicTableController extends Controller
{

    public function createTable($table_name ="example_table",$field_type = []){
        if(!Schema::hasTable($table_name)){
            Schema::create($table_name,function(Blueprint $table) use($field_type){
                $table->increments('id');
                foreach ($field_type as $field){

                    if(array_key_exists('length',$field)){
                        $table->{$field['type']}($field['name'],$field['length']);
                    }else{
                        $table->{$field['type']}($field['name']);
                    }
                }
                $table->timestamps();
            });
            return $table_name.'&nbsp; created successfully';
        }else{
            return "This table already exists";
        }
    }
    public function drawTable(){
        /*
         * <input type="text" name="type[]" />
         * <input type="text" name="field_name[]"/>
         * <input type="number" name="length" /> null
         */
        $field_type = [
            ['type'=>'string','name'=>'title','length'=>50],
            ['type'=>'boolean','name'=>'status'],
            ['type'=>'text','name'=>'description'],
            ['type'=>'dateTime','name'=>'posted_date'],
        ];
        $return_data = $this->createTable('dynamic_table',$field_type);
        return $return_data;
    }

    public function cookies(){

        //$request->cookie('first_cookie');
        $cookie = Cookie::get('products');
       $array = json_decode($cookie,true);
       dd($array);
        $array  = [
            'name'=>'ABC',
            'email'=>'def@gmail.com',
            'connection'=>[
                'time'=>120
            ]
        ];
        $json = json_encode($array);
        return response('Cookie set')->cookie(
          'products',$json,120
        );
    }
}
