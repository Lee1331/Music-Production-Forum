<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required|unique:forum_categories,name',
        ];

        switch($this->method()){
            case 'POST':
                $rules['name'] = 'required|unique:forum_categories,name';

            case 'PUT':
                if($this->route('category')){
                    $rules['name'] = 'required|unique:forum_categories,name,'. $this->route('category')->id;
                }
                else{
                    $rules['name'] = 'required|unique:forum_categories,name';
                }
            break;
        }
        return $rules;
    }
}
