<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {


         echo "<pre>"; 
        print_r($request->all()); exit();
        $studentId = $this->user()->id; 

        return [
            'name'         => 'required|string|min:2|max:255',
            'email'        => ['required', 'email', Rule::unique('students')->ignore($studentId)],
            'mobile'       => 'required|digits:10',
            'apaarId'      => 'required|digits:12',
            'gender'       => 'required|in:Male,Female,Other',
            'dateOfBirth'  => 'required|date',
            'domicile'     => 'required|string|max:100',
            'hobbies'      => 'nullable|string|max:500',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB limit
        ];
    }
}