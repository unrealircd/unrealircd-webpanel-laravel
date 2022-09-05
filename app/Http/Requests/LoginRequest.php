<?php

namespace App\Http\Requests;

use App\Rules\Irc;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // If the user is not authenticated, we'll let them attempt a login.
        if (!auth()->check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required']
        ];
    }
}
