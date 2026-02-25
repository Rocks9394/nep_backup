<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'user_id' => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'gender'  => $this->gender,
            'reg_id'  => $this->self_registrationId,
            'role_id' => $this->role_id,
            'avatar'  => $this->avatar ? asset('public/' . $this->avatar) : null,
            'schools' => $this->schools->map(function ($school) {
                return [
                    'id' => $school->id,
                    'name' => $school->school_name,
                    'logo' => $school->logo
                        ? asset('public/logo/' . $school->logo)
                        : null,
                ];
            }),

            'metadata' => $this->usermeta ? [
                'dob'           => $this->usermeta->dob,
                'qualification' => $this->usermeta->qualification,
            ]
            : null,
        ];
    }

}
