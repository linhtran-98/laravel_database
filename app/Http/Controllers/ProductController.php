<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 5;
        if($request->input('status'))
        {
            $products = DB::table('products')->where('status', $request->input('status'))->orderby('product_id', 'desc')->simplePaginate($limit);
        }
        elseif ($request->input('search')) 
        {
            $products = DB::table('products')->where('name', 'like', "%{$request->input('search')}%")->orderby('product_id', 'desc')->simplePaginate($limit);
        }
        else
        {
            $products = DB::table('products')->orderby('product_id', 'desc')->simplePaginate($limit);
        }

        $category = DB::table('category')->get();
        return view('admin.product.index')->with('title', 'Danh sách sản phẩm')->with(compact('products'))->with(compact('category'))->with(compact('limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm sản phẩm";
        return view('admin.product.add')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $data = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required'
        ],[
            'name.required' => 'Tên sản phẩm không hợp lệ',
            'title.required' => 'Title không hợp lệ',
            'price.required' => 'Giá bán không hợp lệ',
            'image.required' => 'Hình ảnh không hợp lệ',
            'description.required' => 'Chi tiết không hợp lệ',
        ]);

        if($request->image){
            $image = $data['image'];
            $extension = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name,File::get($image));
        }

        DB::table('products')->insert(
            ['name' => $data['name'],
             'title' => $data['title'],
             'price' => $data['price'],
             'image' => $name,
             'description' => $data['description'],
             'created_at' => $created_at,
             'updated_at' => $updated_at
             ]
        );
        return back()->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $title = 'Chi tiết sản phẩm';
        $product = DB::table('products')->where('product_id', $id)->first();
        return view('admin.product.detail')->with('title', $title)->with('product', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Sửa sản phẩm';
        $category = DB::table('category')->get();
        $product = DB::table('products')->where('product_id', $id)->first();
        return view('admin.product.show')->with('title', $title)->with('product', $product)->with(compact('category'));
    }    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $image_update = '';
        $updated_at = date('Y-m-d H:i:s');
        $data = $request->validate([
            'status' => 'required',
            'name' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'nullable',
            'description' => 'required',
            'before_image' => 'required',
            'category' => 'required'
        ],[
            'status.required' => 'Trạng thái không hợp lệ',
            'name.required' => 'Tên sản phẩm không hợp lệ',
            'title.required' => 'Title không hợp lệ',
            'price.required' => 'Giá bán không hợp lệ',
            'description.required' => 'Chi tiết không hợp lệ',
            'category.required' => 'Danh mục không hợp lệ',
        ]);

        $image_update = $data['before_image'];
        if($request->image){
            $image = $data['image'];
            $extension = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name,File::get($image));
            $image_update = $name;
            unlink('uploads/'.$data['before_image']);
        }
        DB::table('products')->where('product_id', $id)->update(
                                                    [   'status' => $data['status'],
                                                       'name' => $data['name'],
                                                        'title' => $data['title'],
                                                        'price' => $data['price'],
                                                        'image' => $image_update,
                                                        'description' => $data['description'],
                                                        'updated_at' => $updated_at,
                                                        'category_id' => $data['category']
                                                    ]
        );
        return back()->with('success', 'Sửa sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->select('image')->where('product_id', $id)->first();
        if($product){
            unlink('uploads/'.$product->image);
        }
        DB::table('products')->where('product_id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            if($request->search != ''){
                $products = DB::table('products')->where('name', 'like', "%{$request->search}%")->get();
                if ($products) {
                    foreach ($products as $key => $value) {
                        $output .= '<a href="'.url('/products/detail/'.$value->product_id).'" class="d-flex align-items-center">
                                        <img src="'.asset('uploads/'.$value->image).'" width="100px" alt="" srcset="">
                                        <p class="text-light m-0 ml-3 text-dark">'.$value->name.'</p>
                                    </a>';
                    }
                }
            }
            return Response($output);
        }
    }
}
