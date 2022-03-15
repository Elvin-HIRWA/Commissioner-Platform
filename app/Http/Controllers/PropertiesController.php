<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Property;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'location' => 'required',
            'image_path' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            
        ]);

        $property =  Property::Create($request->all());

        return response()->json($property, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' =>'required',
            'location' =>'required',
            'image_path' =>'required',
            'status' =>'required'
             
        ]);

        $property = Property::find($id);
        $type =$request->input('type');
        $location = $request->input('location');
        $image_path = $request->input('image_path');
        $status = $request->input('status');

        $property->type = $type;
        $property->location = $location;
        $property->image_path = $image_path;
        $property->status = $sttus;

        $response = [
            'msg' => 'Property update successfully',
            'property' =>$property
        ];


        return response()->json($response, 200);
        

    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $property =Property::find($id);

       if (!$property->delete()) {
      
        return response()->json(['msg' => 'deletion failed'], 404);
      }

      $response = [
          'msg'=>'Property deleted Successfully'
      ];

      return response()->json($response,200);

    
    }
}