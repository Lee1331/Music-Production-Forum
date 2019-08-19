<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
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
        ];

        switch($this->method()){
            case 'POST':
                $rules['title'] = 'required|unique:forum_threads';

            case 'PUT':
                if($this->route('thread')){
                    $rules['title'] = 'required|unique:forum_threads,title,'. $this->route('thread')->id;
                }
                else{
                    $rules['title'] = 'required|unique:forum_threads';
                }
            break;
        }
        return $rules;
    }
}
