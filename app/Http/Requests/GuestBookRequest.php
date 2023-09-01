<?php

namespace App\Http\Requests;

use App\Rules\HtmlTags;
use Illuminate\Foundation\Http\FormRequest;

class GuestBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    //  return kita buat menjadi true agar request ini bisa terpakai
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    // inisiasi field pada table guest_book disini seusai dengan panjang dari typedatanya
    // rule html tags disini adalah agar guest yg iseng tidak memasuki tag html pada form input
    public function rules(): array
    {
        return [
            'name'      => ['required', 'max:150', 'string', new HtmlTags],
            'address'   => ['required','max:255', 'string', new HtmlTags],
            'phone'     => ['string'],
            'comment'   => ['required','string', new HtmlTags]
        ];
    }
}
