<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code_book' => 'required|unique:books,code_book',
            'isbn'      => 'required|integer|digits_between:1,255|unique:books,isbn',
            'title'     => 'required|max:255',
            'publisher' => 'required|max:255',
            'year'      => 'required|min:4',
            'author'    => 'required|max:255',
            'qty'       => 'required|integer|min:0',
            'entry_date' => 'required',
        ];
    }
}
