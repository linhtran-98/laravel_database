<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Danh sách danh mục";
        $category = DB::table('category')->get();
        return view('admin.category.index')->with(compact('category'))->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm Danh Mục";
        return view('admin.category.add')->with('title', $title);
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
            'name' => 'required'
        ],[
            'name.required' => 'Tên danh mục không hợp lệ'
        ]);

        DB::table('category')->insert(
            ['name' => $data['name'],
             'created_at' => $created_at,
             'updated_at' => $updated_at
             ]
        );
        return back()->with('success', 'Thêm danh mục thành công');
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
        $title = 'Sửa sản phẩm';
        $category = DB::table('category')->where('id', $id)->first();
        return view('admin.category.show')->with('title', $title)->with('category', $category);
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
        $updated_at = date('Y-m-d H:i:s');
        $data = $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Tên sản phẩm không hợp lệ'
        ]);

        
        DB::table('category')->where('id', $id)->update(
                                                    [
                                                       'name' => $data['name'],
                                                        'updated_at' => $updated_at
                                                    ]
        );
        return back()->with('success', 'Sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = DB::table('products')->where('category_id', $id)->get();
        if($products){
            foreach ($products as $key => $value) {
                DB::table('products')->where('category_id', $id)->delete();
            }
        }
        DB::table('category')->where('id', $id)->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }
}
