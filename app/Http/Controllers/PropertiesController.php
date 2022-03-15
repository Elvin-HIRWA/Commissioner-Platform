<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PropertiesController extends Controller
{

    protected $property;

    public function __construct(Property $property){
        $this->property = $property;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property= Property::all();
        $response = [
            'properties' => $property
        ];
        return response()->json($response, 200);
        
    
    }

   
    public function store(Request $request)
    {
       
        $request->validate([
            'type' => 'required',
            'location' => 'required',
            //'image_path' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            
        ]);

        $property =  Property::Create([
            'type'=> $request->type,
            'location'=> $request->location,
            //'image_path'=> $request->image_path,
            'status'=> $request->status,
            'user_id'=> Auth()->user()->id

            // $article->author_id=Auth::user()->id;
            // user_id=>$request->Auth

        ]);

        return response()->json($property, 201);
    }




}
