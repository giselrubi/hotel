<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Http\Requests\ReservationsRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ReservationsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsController extends Controller
{
    public function index()//:JsonResource
    {
    
        $reservation = Reservations::all();
        //return ReservationsResource::collection($reservation);
        return response()->json($reservation,200);
    }

    public function store(ReservationsRequest $request):JsonResponse
    {
        //
       $reservation= Reservations::create($request->all());
        return response()->json([
            'success'=>true,
            'data'=> new ReservationsResource($reservation)
        ],201);
        
    }

    public function show($id):JsonResource
    {
        //
        $reservation=Reservations::find($id);
        //return response()->json($note,200);
        return new ReservationsResource($reservation);

    }

   
    public function update(ReservationsRequest $request,  $id)
    {
        //
        $reservation=Reservations::find($id);
        $reservation->reservation=$request->reservation;
        $reservation->types_id=$request->types_id;
        $reservation->places_id=$request->places_id;
        $reservation->customers_id=$request->customers_id;
        $reservation->fecha_inicio=$request->fecha_inicio;
        $reservation->fecha_fin=$request->fecha_fin;
        
        $reservation->save();

        return response()->json([
            'success'=>true,
            'data'=>new ReservationsResource($reservation)
            
        ],200) ;
    }

    public function destroy($id):JsonResponse
    {
        //
        Reservations::find($id)->delete();

        return response()->json([
            'success'=>true
        ],200);
    }

}
