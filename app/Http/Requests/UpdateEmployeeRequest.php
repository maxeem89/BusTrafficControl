<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$this->id,
            'phone' => 'required|regex:/^\d{10}$/',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'حقل الاسم الاول مطلوب.',
            'last_name.required' => 'حقل الاسم الثاني مطلوب.',
            'address.required' => 'حقل العنوان مطلوب.',
            'city.required' => 'حقل الدولة مطلوب.',
            'country.required' => 'حقل المدينة مطلوب.',
            'date_of_birth.required' => 'حقل تاريخ الميلاد مطلوب.',
            'first_name.string' => 'يجب أن يكون حقل الاسم نصًا.',
            'first_name.max' => 'يجب ألا يتجاوز حقل الاسم 255 حرفًا.',
            'last_name.string' => 'يجب أن يكون حقل الاسم نصًا.',
            'last_name.max' => 'يجب ألا يتجاوز حقل الاسم 255 حرفًا.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون حقل البريد الإلكتروني عنوان بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'phone.required' => 'حقل الهاتف مطلوب.',
            'phone.regex' => 'يجب أن يكون حقل الهاتف عبارة عن 10 أرقام.',
            // Add more custom error messages for other validation rules here as needed.
        ];
    }
}
