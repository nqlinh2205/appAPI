<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\Category;
use Codexshaper\WooCommerce\Facades\WooCommerce;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getlist(Request $request){
        $page = substr($request->url(),35);
        $per_page = 10; // Or your desire number
        $current_page = $page; // By default 1. That reurns first 1 to 50. If 2 then return 51 to 100 and vice versa

        $product = Product::paginate($per_page, $current_page);
        // $total_page = $product['meta']['total_pages'];
        // $total_result = $product['meta']['total_results'];
        
        // $product =  WooCommerce::all('products',$options);
        return view('admin/product/index',compact('product'));
    }
    public function index($page = 1)
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        
        // return response()->json($category);
        return view('admin/product/form',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $request->all();
        // dd($result);
        $data = [
            'name' => $request['name'],
            'type' => 'simple',
            'regular_price' => $request['regular_price'],
            'description' => $request['description'],
            'short_description' => $request['short_description'],
            'stock_quantity' => $request['stock_quantity'],
            'categories' => [
                [
                    'id' => $request['category']
                ]
            ],
            'images' => [
                [
                    'src' => $request['images']
                ]
            ]
        ];
        $product = Product::create($data);
        return redirect()->to('product/page/1');

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
        
        $category = Category::all();
        $product = Product::find($id);
        // foreach ($result as $key ){
        //     $product = $key;
        // }
        // dd($product);
        // return response()->json($product);
        return view('admin/product/form',compact('category','product'));
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
        $result = $request->all();
        if($result['images'] == null){
            $data = [
                'name' => $request['name'],
                'type' => 'simple',
                'regular_price' => $request['regular_price'],
                'description' => $request['description'],
                'short_description' => $request['short_description'],
                'stock_quantity' => $request['stock_quantity'],
                'categories' => [
                    [
                        'id' => $request['category']
                    ]
                ]
                
            ];
        } else{
            $data = [
                'name' => $request['name'],
                'type' => 'simple',
                'regular_price' => $request['regular_price'],
                'description' => $request['description'],
                'short_description' => $request['short_description'],
                'stock_quantity' => $request['stock_quantity'],
                'categories' => [
                    [
                        'id' => $request['category']
                    ]
                ],
                'images' => [
                    [
                        'src' => $request['images']
                    ]
                ]
            ];

        }
        
            $data = [
                'name' => $request['name'],
                'type' => 'simple',
                'regular_price' => $request['regular_price'],
                'description' => $request['description'],
                'short_description' => $request['short_description'],
                'stock_quantity' => $request['stock_quantity'],
                'categories' => [
                    [
                        'id' => $request['category']
                    ]
                ]
                // ,
                // 'images' => [
                //     [
                //         'src' => $request['images']
                //     ]
                // ]
            ];

        $product = Product::update($id, $data);
        return redirect()->to('product/page/1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $product_id = $id;
        $options = ['force' => true]; // Set force option true for delete permanently. Default value false
        $product = Product::delete($product_id, $options);
        return redirect()->to('product/page/1');
    }
}
