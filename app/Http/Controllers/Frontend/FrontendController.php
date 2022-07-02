<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slide;
use App\Models\Social_media;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        $sliders = Slide::find(1);


        return view('frontend.index' , compact('product_categories' , 'sliders'));
    }



    public function shop($slug = null)
    {
        return view('frontend.shop',compact('slug'));
    }
    public function shop_tag($slug = null)
    {
        return view('frontend.shop_tags',compact('slug'));
    }

    public function product($slug)
    {


        $product = Product::with('media' , 'category' , 'tags' , 'reviews')->withAvg('reviews' , 'rating')->whereSlug($slug)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use ($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->Active()->HasQuantity()->take(4)->get();
        return view('frontend.product' , compact('product' , 'relatedProducts' ));
    }
    public function cart()
    {
        return view('frontend.cart');
    }
    public function wishlist()
    {
        return view('frontend.wishlist');
    }







}
