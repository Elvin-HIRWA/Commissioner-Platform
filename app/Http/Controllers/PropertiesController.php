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
            "msg" =>'All properties',
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
            // 'user_id' => 'required',
            
        ]);

           $property =  Property::Create([
            'type'=> $request->type,
            'location'=> $request->location,
            //'image_path'=> $request->image_path,
            'status'=> $request->status,
            'user_id'=> $request->user_id

            // $article->autho;r_id=Auth::user()->id;
            // user_id=>$request->Auth

        ]);
            
        return response()->json($property, 201);
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
            'status' =>'required',
            'user_id'=> 'required'
             
        ]);
        
        $type =$request->input('type');
        $location = $request->input('location');
        $status = $request->input('status');
        $user_id =  $request->input('user_id');

        $property = Property::find($id);

      

        $property->type = $type;
        $property->location = $location;
        $property->status = $status;
        $property->user_id = $user_id;

        $property->save();


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