<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

use function PHPSTORM_META\customers;

class CustomersController extends Controller
{
    public function list(){
        $customers = Customers::all();
        $list = [];

        foreach($customers as $customers) {
            $objet = [
                "id" => $customers->id,
                "nombre" => $customers->name,
                "apellido" => $customers->last_name,
                "telefono" => $customers->phone,
                "correo" => $customers->email,
            ];
            array_push($list, $objet);
        }
        return response()->json($list);
    }
    

     public function getByid($id){
         $customers = customers::where('id','=',$id)->first();
        $objet = [
            "id" => $customers->id,
            "nombre" => $customers->name,
            "apellido" => $customers->last_name,
            "telefono" => $customers->phone,
            "correo" => $customers->email,
        ];
        return response()->json($objet);
    }
    public function create(Request $request){
        $data = $request->validate([
            'name'=>'required|min:3',
            'last_name'=>'required|min:4',
            'phone'=>'required|numeric|min:10|max:30',
            'email'=>'required|min:4'
        ]);
        $place=customers::create([
            'name'=>$data['name'],
            'last_name'=>$data['last_name'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
    
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
                'last_name'=>'required',
                'phone'=>'required',
                'email'=>'required',
            ]);
            $customers = customers::where('id','=',$data['id'])->first();
            if($customers){
                $old=$customers;
                $customers->name = $data['name'];
                $customers->last_name = $data['last_name'];
                $customers->phone = $data['phone'];
                $customers->email = $data['email'];
                
                if($customers->save()){
                    $objet = [
                        "response"=>'Succces.Item update correctly.',
                        "old"=>$old,
                        "new"=>$customers
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

    



