<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        //almaceno el registro del post que quiero actualizar
        $post = $this->route()->parameter('post');//nul'

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];
        //regla de validacion para cuando quiero editar un registro que ya tiene un slug
        if($post){
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        if($this->status == 2){
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required'
            ]);
        }
        return $rules;
    }
}
