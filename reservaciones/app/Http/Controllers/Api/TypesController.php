<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;

use function PHPSTORM_META\pleaces;

class TypesController extends Controller
{
    public function list(){
        $pleaces = Types::all();
        $list = [];

        foreach($pleaces as $pleaces) {
            $objet = [
                "id" => $pleaces->id,
                "name" => $pleaces->name,
                
            ];
            array_push($list, $objet);
        }
        return response()->json($list);
    }
    

     public function getByid($id){
         $pleaces = Types::where('id','=',$id)->first();
        $objet = [
            "id" => $pleaces->id,
            "name" => $pleaces->name,
            
        ];
        return response()->json($objet);
    }
    public function create(Request $request){
        $data = $request->validate([
            'name'=>'required|min:3',  
        ]);
        $place=Types::create([
            'name'=>$data['name'],
          
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
            'name'=>'required|min:3',
            
        ]);
        $types = types::where('id','=',$data['id'])->first();
        if($types){
            $old=$types;
            $types->name = $data['name'];
            
            
            if($types->save()){
                $objet = [
                    "response"=>'Succces.Item update correctly.',
                    "old"=>$old,
                    "new"=>$types
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
        public function delete($id)
        {
            // Buscar el tipo por su ID
            $types = Types::find($id);
            
            // Verificar si se encontró el tipo
            if ($types) {
                // Eliminar el tipo
                $types->delete();
                
                // Responder con un mensaje de éxito
                return response()->json([
                    'message' => 'Tipo eliminado con éxito',
                    'id' => $id
                ]);
            } else {
                // Responder con un mensaje de error si no se encontró el tipo
                return response()->json([
                    'message' => 'Error: Tipo no encontrado',
                    'id' => $id
                ]);
            }
        }
}     




      
