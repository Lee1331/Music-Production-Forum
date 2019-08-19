<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'body' => 'required',
            'excerpt' => 'required|bail|nullable|max:256',
            'header_image' => 'image|nullable|max:1999',
            'body_image' => 'image|nullable|max:1999',
        ];

        switch($this->method()){
            case 'POST':
                $rules['title'] = 'required|unique:articles';
            case 'PUT':
                if($this->route('article')){
                    $rules['title'] = 'required|unique:articles,title,'. $this->route('article')->id;
                }
                else{
                    $rules['title'] = 'required|unique:articles';
                }
            break;
        }
        return $rules;
    }
}

