<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'min:10',
            ],

            'location' => [
                'required',
                'date',
                'after:now',
            ],

            'start_at' => [
                'required',
                'date',
                'after:now',
            ],

            'end_at' => [
                'required',
                'date',
                'after:start_at',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:sheduled,canceled',
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $event = this->route('event');
                   if(!event instanceof Event) {
                    return;
                   }

                    $confirmed = $event
                      ->registrations()
                      ->where('status', 'confirmed')
                      ->count();

                      if((int) $this->input('capacity')< $confirmed) {
                        $validator->errors()->add(
                            'capacity',
                            "A capacidade não pode ser menor que {$confirmed}, pois existem inscrições confirmadas."
                        );
                    }
            },
        ];
    }
}
