<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Responce;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ProductController extends Controller {

    public function __construct(ProductRepository $products) {
        $this->middleware('auth');

        $this->products = $products;
    }

    public function index(Request $request) {
        return view('products.index', [
            'products' => $this->products->forUser($request->user()),
        ]);
    }

    /**
     * Create new product.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'quantity' => 'required|integer|max:255',
            'price' => 'required|integer|max:255',
        ]);

        $request->user()->products()->create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect('/products');
    }

    /**
     * 
     * @param \App\Http\Controllers\Product $product
     * @return type
     */
    public function destroy(Product $product) {

        $this->authorize('destroy', $product);

        $product->delete();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {

        return response()->json($product)
                        ->header('Cache-Control', 'public')
                        ->header('Content-Description', 'File Transfer')
                        ->header('Content-Disposition', 'attachment; filename=' . $product->name . '.json')
                        ->header('Content-Transfer-Encoding', 'binary')
                        ->header('Content-Type', 'text/plain');
    }

}
