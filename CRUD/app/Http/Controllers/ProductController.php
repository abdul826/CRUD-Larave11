<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductController extends Controller
{
    //This method will show Products in UI
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('product.list',[
            'products'=> $products
        ]);
    }

    //This method will create Product
    public function create(){
        return view('product.create');
    }

    //This method will store products in DB
    public function store(Request $request){
        $rules = [
            'name'=> 'required|min:5',
            'sku'=> 'required|min:3',
            'price'=> 'required|numeric',
        ];

        if($request->image != ''){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('product.create')->withInput()->withErrors($validator);
        }

        //Create Instance of Product Which is created in Model
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // Store image in DB
        if($request->image != ''){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time(). '.' . $ext;

            // Save image to products folder
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();   // Save Image name in DB
        }

        return redirect()->route('product.index')->with("success", "Product Added Successfully");
    }

    //This method will edit the product
    public function edit($id){
        $product = Product::findOrFail($id);  // fetch data of particular ID
        return view('product.edit',[
            'product'=>$product
        ]);
    }

    //This method will update the product
    public function update($id, Request $request){
        $product = Product::findOrFail($id);

        $rules = [
            'name'=> 'required|min:5',
            'sku'=> 'required|min:3',
            'price'=> 'required|numeric',
        ];

        if($request->image != ''){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('product.create', $id)->withInput()->withErrors($validator);
        }

        //Create Instance of Product Which is created in Model
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // Store image in DB
        if($request->image != ''){
            // Delete Old Image
            File::delete(public_path('uploads/products/'. $product->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time(). '.' . $ext;

            // Save image to products folder
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();   // Save Image name in DB
        }

        return redirect()->route('product.index')->with("success", "Product Updated Successfully");

    }

    //This method will delete the product
    public function destroy($id){
        $product = Product::findOrfail($id);

        // Delete Image
        File::delete(public_path('uploads/products/'. $product->image));

        // Delete the Product
        if($product->delete()){
            return redirect()->route('product.index')->with("success", "Product delete successfully");
        }
    }
}
