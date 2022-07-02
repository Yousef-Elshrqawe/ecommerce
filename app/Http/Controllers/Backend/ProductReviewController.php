<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductreviewRequest;
use App\Models\ProductReview;
use App\Models\ProductReviwe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductReviewController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_product_reviews, show_product_reviews')) {
            return redirect('admin/index');
        }

        $reviews = ProductReview::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('backend.product_reviews.index', compact('reviews'));
    }
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }

        $main_reviews = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        return view('backend.product_reviews.create', compact('main_reviews'));

    }
    public function store(ProductCategoryRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_product_reviews')) {
            return redirect('admin/index');
        }
        try {
            $input['name'] = $request->name;
            $input['status'] = $request->status;
            $input['parent_id'] = $request->parent_id;

            if ($image = $request->file('cover')) {
                $file_name = Str::slug($request->name) . "." . $image->getClientOriginalExtension();
                $path = public_path('/assets/product_reviews/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['cover'] = $file_name;
            }
            ProductCategory::create($input);

            return redirect()->route('admin.product_reviews.index')->with([
                'message' => 'Created successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $ex) {
            //عرض  ايرور  لارفيل
            // return redirect()->back()->withErrors(['error' => $ex ->getMessage()]);
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }
    }
    public function show(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'display_product_reviews')) {
            return redirect('admin/index');
        }
        return view('backend.product_reviews.show' , compact('productReview'));

    }
    public function edit(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }

        return view('backend.product_reviews.edit', compact( 'productReview'));

    }
    public function update(ProductreviewRequest $request, ProductReview $productReview)
    {

        if (!auth()->user()->ability('admin', 'update_product_reviews')) {
            return redirect('admin/index');
        }
        try {

            $productReview->update($request->validated());


            return redirect()->route('admin.product_reviews.index')->with([
                'message' => 'Updated successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $ex) {
            //عرض  ايرور  لارفيل
            // return redirect()->back()->withErrors(['error' => $ex ->getMessage()]);
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }
    }
    public function destroy(ProductReview $productReview)
    {
        if (!auth()->user()->ability('admin', 'delete_product_reviews')) {
            return redirect('admin/index');
        }

        $productReview->delete();

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
