<?php

namespace App\Http\Requests;

use App\Models\Result;
use App\Rules\AfterNow;
use App\Rules\NotYetOut;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResultRequest extends FormRequest
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
        return [
            'number' => 'required|digits:4|numeric',
            'out_at' => [
                'required',
                'date_format:m/d/Y H:i',
                // new AfterNow(),
                // new NotYetOut(Result::findOrFail($this->id)),
            ]
        ];
    }
}
