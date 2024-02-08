<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function store(Request $request){
        $request -> validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required'
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ]);
        // dd($request->input());
        $product = new Product();
        $product->title = $request->title;
        $product->category= $request->category;
        $product->description= $request->description;
        $product->price = $request->price;

        $imageData = $request->file('image');
        $extension = $imageData->extension();
        $filename = date('YmdHis') . '.' . $extension;
       // $imagePath = public_path('uploads/' . $filename);
        $imagePath = 'uploads/' . $filename;

        try {
            // Move image to the uploads directory
            $imageData->move(public_path('uploads/'), $filename);
            // Save relative image path
            $product->image = $imagePath;
            // Read and encode the image as base64
            $imageBase64 = base64_encode(file_get_contents(public_path($imagePath)));
            // Save base64 representation
            $product->imagebase64 = $imageBase64;
        } catch (Exception $e) {
            // Handle the exception
        }
    
        $product->save();
        return redirect()-> route('products.create');
        // dd($request->input());
    }
    public function update($id, Request $request){
        $request -> validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required'
            // 'image' => 'required'
        ]);
        $product = Product::where("id", $id)-> first();
        if($request->hasFile('image')){
            $request -> validate([
                'image' => 'required'
            ]);
            if(file_exists(public_path('uploads/' .$product->image)) AND !empty($product->image)){

                unlink(public_path('uploads/' .$product->image));
            }
            //        //image
            // $extension = $request->file('image')->extension();
            // $filename = date('YmdHis').'.'.$extension; //20230720203055.jpg 
            // $request->file('image')->move(public_path('uplaods/'), $filename);
            // $product->title = $request->title;
            // $product->category= $request->category;
            // $product->description= $request->description;
            // $product->price = $request->price;
            // $product->image = $filename;
            // $product->update();
            // Upload and save the new image
            $extension = $request->file('image')->extension();
            $filename = date('YmdHis') . '.' . $extension;
            $request->file('image')->move(public_path('uploads/'), $filename);
                   // Save the image path with the "uploads/" prefix
            $product->image = 'uploads/' . $filename;

            // Read and encode the new image as base64
            $imageBase64 = base64_encode(file_get_contents(public_path('uploads/' . $filename)));
            $product->imagebase64 = $imageBase64;
        }
        // dd($request->input());
        $product->title = $request->title;
        $product->category= $request->category;
        $product->description= $request->description;
        $product->price = $request->price;
        // $product->update();
        try {
            $product->save();
        } catch (\Exception $e) {
            // Handle the exception, log it, and return a response
            return redirect()->back()->with('error', 'Error updating product.');
        }
        return redirect()-> route('products.show');

    }
    public function edit($id){
        $product = Product::where("id", $id)->first();
     
        return view("products.edit", compact('product'));

     
    }
    public function delete($id){
        $product = Product::where("id", $id)->first();

        if(file_exists(public_path('uploads/' .$product->image)) AND !empty($product->image)){
            unlink(public_path('uploads/' .$product->image));
        }
        $product->delete();
        return redirect()-> route('products.show');

     
    }
    public function show(){
        $products = Product::orderBy("id", "desc")->get();

        return view("products.show", compact('products'));
    }
    public function showjson()
    {
        try {
            $products = Product::orderBy("id", "desc")->get();
            $message = 'Products retrieved successfully';
            $statusCode = 200;
                    // Encode images to base64 and include in the response
        foreach ($products as $product) {
            $product->imagebase64 = base64_encode(file_get_contents(public_path($product->image)));
        }
        } catch (\Exception $e) {
            $products = [];
            $message = 'Error retrieving products';
            $statusCode = 500; // Internal Server Error
        }
    
        return response()->json([
            'data' => $products,
            'message' => $message,
        ], $statusCode);
    }
    public function showJsonById($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new \Exception('Product not found', 404);
            }

            $product->imagebase64 = base64_encode(file_get_contents(public_path($product->image)));

            $message = 'Product retrieved successfully';
            $statusCode = 200;
        } catch (\Exception $e) {
            $product = null;
            $message = $e->getMessage();
            $statusCode = $e->getCode() ?: 500; // Internal Server Error if no specific code is set
        }

        return response()->json([
            'data' => $product,
            'message' => $message,
        ], $statusCode);
    }

    


}
