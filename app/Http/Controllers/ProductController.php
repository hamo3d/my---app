<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // $data = Product::with('Category')->get();

        // $data = Product::with(['category'])->whereHas('category',function($query){

            // $query->where('name','like','a%');

        // })->get();

        $data = Product::with(['category'=>function($query){
            $query->where('name','like','a%');
        }])->get();
        return response()->json(['stauts' => true , 'message' => 'sucess' , 'object' =>$data],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
