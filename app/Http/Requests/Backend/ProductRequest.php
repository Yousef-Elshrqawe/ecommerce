<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'status' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'quantity' => 'required|numeric',
                    'product_category_id' => 'required',
                    'tags.*' => 'required',
                    'featured' => 'required',
                    'images' => 'required',
                    'images.*' => 'mimes:jpg,jpeg,png ,gif|max:60000',

                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name' => 'required|max:255',
                    'status' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'quantity' => 'required|numeric',
                    'product_category_id' => 'required',
                    'tags.*' => 'required',
                    'featured' => 'required',
                    'images' => 'nullable',
                    'images.*' => 'mimes:jpg,jpeg,png ,gif|max:60000',
                ];
            }


            default:break;
        }





        return [

        ];
    }
}
