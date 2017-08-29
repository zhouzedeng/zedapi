<?php

namespace Modules\Product\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Hashids;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $_category_id = $request->input('_category_id');
        $category_id  = Hashids::decode($_category_id);
        if (!$category_id) {
            return error('category.invalid');
        }

        $model = Product::select(['id', 'sale_type', 'cover', 'name', 'sales_volume', 'price']);
        $model->where('category_id', $category_id);
        $products = $model->paginate(10);

        foreach ($products as $key => $product) {
            $products[$key]['_id'] = Hashids::encode($product->id);
            $products[$key]['sale_type_text'] = $product->saleTypeText();
            $products[$key]['price']          = $product->price / 100.0;
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
            return error('product.invalid');
        }

        $model = Product::select(['id', 'sale_type', 'cover', 'name', 'sales_volume', 'price']);
        $model->where('id', $product_id);
        $product = $model->first();

        if (!$product) {
            return error('product.not.found');
        }
        $data                   = [];
        $data['_id']            = Hashids::encode($product->id);
        $data['sale_type']      = $product->sale_type;
        $data['sale_type_text'] = $product->saleTypeText();
        $data['cover']          = $product->cover;
        $data['name']           = $product->name;
        $data['sales_volume']   = $product->sales_volume;
        $data['price']          = $product->price / 100.0;

        // Product photos
        $photos = $product->photos()->select(['url'])->get();
        foreach ($photos as $photo) {
            $data['photos'][] = $photo->url;
        }

        return success('success', $data);
    }
}
