<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'   => 'required|min:3',
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title'   => trans('models.article.title'),
            'content'   => trans('models.article.content')
        ];
    }
}
