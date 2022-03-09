<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;


class PropertyController extends Controller
{
    /**
     * @OA\Get(
     *      path="/properties",
     *      operationId="getProperties",
     *      tags={"Tests"},
     *      summary="Récupéré la liste des propriétés",
     *      description="Retourne la liste complète de toute les propriétés.",
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     *  )
     */
    public function index(){

        $properties = Property::all();

        if(count($properties) > 0){
            return response()->json($properties, 200);
        }else{
            return response()->json(['message' => 'Not Found!'], 404);
        };

    }

    /**
     * @OA\Get(
     *      path="/property/{id}",
     *      operationId="getOneProperty",
     *      tags={"Tests"},

     *      summary="Récupéré une propriété",
     *      description="Retourne une propriété.",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     *  )
     * 
     * Show the property.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $property =  Property::find($id);
            if($property){
                return response()->json($property, 200);
            }else{
                return response()->json(['message' => 'Not Found!'], 404);
            };

    }

    /**
     * @OA\Post(
     *      path="/property/create",
     *      summary="Ajouter une propriété",
     *      operationId="AddOneProperty",
     *      tags={"Tests"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Proprietes",
     *      @OA\JsonContent(
     *          required={"title", "description", "image", "postcode", "city", "address", "room", "price", "size", "floor" },
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="string"),
     *          @OA\Property(property="image", type="string"),
     *          @OA\Property(property="address", type="string"),
     *          @OA\Property(property="postcode", type="string"),
     *          @OA\Property(property="city", type="string"),
     *          @OA\Property(property="room", type="number"),
     *          @OA\Property(property="price", type="number"),
     *          @OA\Property(property="size", type="number"),
     *          @OA\Property(property="floor", type="number"),
     *      ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     * 
     *  )
     * 
     * Create a new property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description'=> 'required',
            'image'=> 'required',
            'room'=> 'required',
            'price'=> 'required',
            'size'=> 'required',
            'floor'=> 'required',
            'address'=> 'required',
            'postcode'=> 'required',
            'city'=> 'required',
        ]);

        $property = Property::create([
            'title' => $request->title,
            'description'=> $request->description,
            'image'=> $request->image,
            'room'=> $request->room,
            'price'=> $request->price,
            'size'=> $request->size,
            'floor'=> $request->floor,
            'address'=> $request->address,
            'postcode'=> $request->postcode,
            'city'=> $request->city,
        ]);

        return response()->json($property, 201);
    }

    /**
     * @OA\Put(
     *      path="/property/{id}/update",
     *      summary="Modifier une propriété",
     *      operationId="UpdateOneProperty",
     *      tags={"Tests"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Proprietes",
     *      @OA\JsonContent(
     *          required={"title", "description", "image", "postcode", "city", "address", "room", "price", "size", "floor" },
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="string"),
     *          @OA\Property(property="image", type="string"),
     *          @OA\Property(property="address", type="string"),
     *          @OA\Property(property="postcode", type="string"),
     *          @OA\Property(property="city", type="string"),
     *          @OA\Property(property="room", type="number"),
     *          @OA\Property(property="price", type="number"),
     *          @OA\Property(property="size", type="number"),
     *          @OA\Property(property="floor", type="number"),
     *      ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     *  )
     * Update the given property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'description'=> 'required',
            'image'=> 'required',
            'room'=> 'required',
            'price'=> 'required',
            'size'=> 'required',
            'floor'=> 'required',
            'address'=> 'required',
            'postcode'=> 'required',
            'city'=> 'required',
        ]);

        $property = Property::find($id);

        if(!$property){
           return response()->json(['message' => 'Not Found!'], 404);
        }

        $property->update([
            'title' => $request->title,
            'description'=> $request->description,
            'image'=> $request->image,
            'room'=> $request->room,
            'price'=> $request->price,
            'size'=> $request->size,
            'floor'=> $request->floor,
            'address'=> $request->address,
            'postcode'=> $request->postcode,
            'city'=> $request->city,
        ]);
        return response()->json($property, 200);
    }

    
    /**
     * @OA\Delete(
     *      path="/property/{id}/delete",
     *      tags={"Tests"},
     *      operationId="deleteOnePorperty",
     *      summary="Delete one porperty",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,  
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Requête erroné"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page introuvable"
     *      ),
     * )
     * 
     * Remove the given property.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);
        if(!$property){
            return response()->json(['message' => 'Not Found!'], 404);
         }
        $property->delete();
        return response()->json(['message' => 'success'], 200);
    }

}
