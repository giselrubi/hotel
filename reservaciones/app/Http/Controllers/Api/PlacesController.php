<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Places;
use Illuminate\Http\Request;

use function PHPSTORM_META\types;

class PlacesController extends Controller
{
    public function list(){
        $types = Places::all();
        $list = [];

        foreach($types as $types) {
            $objet = [
                "id" => $types->id,
                "ciudad" => $types->city,
                "ubicacion" => $types->location,
            ];
            array_push($list, $objet);
        }
        return response()->json($list);
    }
    

     public function getByid($id){
         $types = Places::where('id','=',$id)->first();
        $objet = [
            "id" => $types->id,
            "ciudad" => $types->city,
            "ubicacion" => $types->location,
        ];
        return response()->json($objet);    
 
    }
    public function create(Request $request){
        $data = $request->validate([
            'city'=>'required|min:10',
            'location'=>'required|min:30'
           
        ]);
        $place=Places::create([
            'city'=>$data['city'],
            'location'=>$data['location'],
        ]);

        if($place){
            return response()->json([
                'message'=>'exito',
                'data'=>$place,

            ]);
        }else{
            return response()->json([
            'message'=>'error',
            'data'=>$place
            ]);
        }
    } 
    public function update(Request $request){
        $data = $request->validate([
            'id'=>'required|integer|min:1',
            'city'=>'required|min:3',
            'location'=>'required',
            
        ]);
        $places = places::where('id','=',$data['id'])->first();
        if($places){
            $old=$places;
            $places->name = $data['city'];
            $places->last_name = $data['location'];
            
            if($places->save()){
                $objet = [
                    "response"=>'Succces.Item update correctly.',
                    "old"=>$old,
                    "new"=>$places
                ];
                return response()->json($objet);
            }else{
                $objet =[
                    "response" =>'Error:something went wrong,please try again.'
                ];
                return response()->json($objet);
            }

            }else{
                $objet =[
                    "response"=>'Error:Element not found.',
                ];
                return response()->json($objet);
            }
        }
}     

