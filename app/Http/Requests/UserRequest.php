<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return Gate::allows('update', $this->route('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //specify inital validation rules
        $rules = [
            'bio' => 'bail|nullable|max:128',
            'profile_image' => 'image|nullable|max:1999'
        ];
        //depending on the request type, add different validation to the email and name fields
        switch($this->method()){
            case 'POST':
                $rules['name'] = 'required|unique:users| min:3';
                $rules['email'] = 'required|unique:users| email';
            case 'PUT':
                if($this->route('user')){
                    $rules['name'] = 'required|min:3|unique:users,name,'. $this->route('user')->id;
                    $rules['email'] = 'required|email|max:255|unique:users,email,'. $this->route('user')->id;
                }
                else{
                    $rules['name'] = 'required|min:3|unique:users';
                    $rules['email'] = 'required|unique:users| email';
                }
            break;
        }
        return $rules;
    }
}
