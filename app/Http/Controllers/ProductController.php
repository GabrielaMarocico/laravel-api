<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return response()->json(Product::all(), 200);

        $products = Product::all();

        $response = APIHelpers::createAPIResponse(false, 200, null, $products);

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product_saved = $product->save();

        if ($product_saved) {
            $response = APIHelpers::createAPIResponse(false, 201, 'Product added', $product);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'Product not added', $product);
            return response()->json($response, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            $response = APIHelpers::createAPIResponse(true, 404, 'Product not found', null);
            return response()->json($response, 404);
        }

        $response = APIHelpers::createAPIResponse(false, 200, null, $product);
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
//            return response()->json('Product not found', 404);
            $response = APIHelpers::createAPIResponse(true, 404, 'Product not found', null);
            return response()->json($response, 404);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        dd($product);

        $product_saved = $product->save();

        if ($product_saved) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Product saved', $product);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'Product not saved', $product);
            return response()->json($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
//            return response()->json('Product not found', 404);

            $response = APIHelpers::createAPIResponse(true, 404, 'Product not found', $product);
            return response()->json($response, 404);
        }

        $product_deleted = $product->delete();

        if ($product_deleted) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Product deleted', $product);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'Product not deleted', $product);
            return response()->json($response, 404);
        }
    }
}
