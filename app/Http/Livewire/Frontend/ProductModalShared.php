<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Product;
use Livewire\Component;

class ProductModalShared extends Component
{
    use LivewireAlert;

    public $productModelCount = false;
    public $productModel = [];
    public $quantity = 1;
    protected $listeners = ['showProductModalAction'];


    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }

    }

    public function increaseQuantity()
    {
        if ($this->productModel->quantity > $this->quantity) {
            $this->quantity++;
        } else {
            $this->alert('warning', 'this is maximum quantity you can add!');
        }

    }

    public function addToCart()
    {
        $duplicates = Cart::instance('default')->search(function ($cartItem , $rowId){
           return $cartItem->id === $this->productModel->id;
        });

        if ($duplicates->isNotEmpty()){
            $this->alert('error' , 'product already exist !');
        }
        else{
            Cart::instance('default')->add($this->productModel->id, $this->productModel->name, $this->quantity, $this->productModel->price)->associate(Product::class);
            $this->quantity = 1 ;
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your cart successfully . ');
        }


    }


    public function addToWishList()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem , $rowId){
           return $cartItem->id === $this->productModel->id;
        });

        if ($duplicates->isNotEmpty()){
            $this->alert('error' , 'product already exist !');
        }
        else{
            Cart::instance('wishlist')->add($this->productModel->id, $this->productModel->name, 1 , $this->productModel->price)->associate(Product::class);
            $this->emit('updateCart');
            $this->alert('success', 'Product added in your Wish List Cart successfully . ');
        }


    }

    public function showProductModalAction($slug)
    {
        $this->productModelCount = true;
        $this->productModel = Product::withAvg('reviews', 'rating')->whereSlug($slug)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        // dd($this->productModel);

    }

    public function render()
    {
        return view('livewire.frontend.product-modal-shared', [
            'position' => 'center-start']);
    }
}
