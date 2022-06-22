<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use DataTables;
    
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with("category")->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {

                            $btn = '

                           <div class="btn-group">
                            <a href="'.url("products/".$row->id).'" class="btn btn-primary">View</a>
                            <a href="'.route("products.edit",$row->id).'" type="button" class="btn btn-warning">Edit</a>
                            <form action="'.route("products.destroy",$row->id).'" method="POST">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button type="submit" class="edit btn btn-danger"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                >Delete</a>
                            </form>
                          </div>                           
                           ';
     
                           
                            return $btn;
                    })
                    ->addColumn('category',function($row){
                        $btn = '<button class="btn btn-link category_link" data-id='.$row->category->id.'>'.$row->category->name.'</button>';
                        return $btn;
                    })
                    ->rawColumns(['action','category'])
                    ->make(true);
        }
        
        return view('products.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::pluck("name","id")->all();
        return view('products.create', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required',
        ]);
        $data = [
            'name' => $request["name"],
            'description' => $request["description"],
            'price' => $request["price"],
            'image' => "",
            'category_id' => $request["category"],
        ];
        if($request->hasfile('image'))
        {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            
            $data["image"] = $imageName;  
        }

        Product::create($data);
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck("name","id")->all();
        return view('products.edit',compact('product','categories'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

         $data = [
            'name' => $request["name"],
            'description' => $request["description"],
            'price' => $request["price"],
            'category_id' => $request["category"],
        ];

        if($request->hasfile('image'))
        {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            
            $data["image"] = $imageName;  
        }
    
        $product->update($data);
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}