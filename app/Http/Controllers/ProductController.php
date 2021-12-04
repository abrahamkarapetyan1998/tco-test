<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaeteProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Services\ImageUploadService;
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
        $products = auth()->user()->products()->with('category')->paginate(15);

        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderByDesc('name')->pluck('name', 'id');
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreaeteProductRequest $request, ImageUploadService $imageUploadService)
    {
        $data = $request->validated();
        if ($request->file('image')) {
            $data['image'] = $imageUploadService->make($request->image)->resize('resize', [840 => null])->path('products')->upload();
        }
        $data['user_id'] = auth()->id();
        Product::create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.single')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        abort_if(!$product->isMine(), 403);
        $categories = Category::orderByDesc('name')->pluck('name', 'id');

        return view('product.edit')->with(['product' => $product , 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreaeteProductRequest $request, Product $product, ImageUploadService $imageUploadService)
    {
        abort_if(!$product->isMine(), 403);

        if ($request->file('image')) {
            $data['image'] = $imageUploadService->make($request->image)->deleteImage($product->image)->resize('resize', [840 => null])->path('products')->upload();
        }
        $data = $request->validated();
        $product->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     */
    public function destroy(Product $product)
    {
        abort_if(!$product->isMine(), 403);

        $product->delete();

        return redirect()->back();
    }
}
