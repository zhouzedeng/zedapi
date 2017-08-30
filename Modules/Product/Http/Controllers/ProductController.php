<?php

namespace Modules\Product\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Hashids;
use Faker\Provider\Company;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($comkey) {
    	$company_id =  hash_decode($comkey);
        $products = DB::table('products')
        	->select(['id', 'cover', 'name', 'old_price','price','unit','status','introduce'])
			->where('company_id',$company_id)
			->whereNull('deleted_at')
			->get();

        foreach ($products as $product) {
            $product->_id = Hashids::encode($product->id);
        }
        return success('success', $products);
    }

    /**
     * Display the specified resource.
     *
     * @param  hash $_product_id
     * @return \Illuminate\Http\Response
     */
    public function show($_product_id) {
        $product_id = Hashids::decode($_product_id);
        if (!$product_id) {
            return error('非法的商品ID');
        }

        $product = DB::table('products')
        	->select(['id', 'cover', 'name', 'old_price','price','unit','status','introduce'])
			->where('id',$product_id)
			->whereNull('deleted_at')
			->first();
        if (!$product) {
            return error('没有该商品');
        }
        $data                   = [];
        $data['_id']            = Hashids::encode($product->id);
        $data['name']      		= $product->name;
        $data['old_price'] 		= $product->old_price;
        $data['cover']          = $product->cover;
        $data['name']           = $product->name;
        $data['price']   		= $product->price;
        $data['unit']           = $product->unit;
        $data['status']         = $product->status;
        $data['introduce']      = $product->introduce;
        
        return success('success', $data);
    }
}
