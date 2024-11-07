<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|unique:guests,phone',
            'country' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Пожалуйста, укажите имя.',
            'first_name.string' => 'Имя должно быть строкой.',
            'first_name.max' => 'Имя не должно превышать 255 символов.',

            'last_name.required' => 'Пожалуйста, укажите фамилию.',
            'last_name.string' => 'Фамилия должна быть строкой.',
            'last_name.max' => 'Фамилия не должна превышать 255 символов.',

            'email.required' => 'Электронная почта обязательна для заполнения.',
            'email.email' => 'Пожалуйста, укажите действительный адрес электронной почты.',
            'email.unique' => 'Такой адрес электронной почты уже зарегистрирован.',

            'phone.required' => 'Номер телефона обязателен для заполнения.',
            'phone.string' => 'Номер телефона должен быть строкой.',
            'phone.unique' => 'Этот номер телефона уже зарегистрирован.',

            'country.string' => 'Название страны должно быть строкой.',
            'country.max' => 'Название страны не должно превышать 255 символов.',
        ];
    }
}
