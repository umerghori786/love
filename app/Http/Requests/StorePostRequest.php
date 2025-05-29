<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
    protected function prepareForValidation(): void
    {   
        if($this->filled('due_date'))
        {
            $this->merge([
                'due_date' => str_replace('T', ' ', $this->input('due_date'))
            ]);
        }
        if($this->filled('remiander_date'))
        {
            $this->merge([
                'remiander_date' => str_replace('T', ' ', $this->input('remiander_date'))
            ]);
        }
        
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'due_date'=>'required|date',
            'remiander_date'=>'nullable|date'
        ];
    }
}
