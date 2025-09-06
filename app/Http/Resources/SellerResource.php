<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "companyName" => $this->company_name,
            "companyRegistrationNumber" => $this->company_registration_number,
            "companyAddress" => $this->company_address,
            "companyCity" => $this->company_city,
            "companyState" => $this->company_state,
            "companyCountry" => $this->company_country,
            "companyPostalCode" => $this->company_postal_code,
            "companyPhone" => $this->company_phone,
            "companyWebsite" => $this->company_website,
            "contactPersonName" => $this->contact_person_name,
            "contactPersonPosition" => $this->contact_person_position,
            "contactPersonEmail" => $this->contact_person_email,
            "contactPersonPhone" => $this->contact_person_phone
        ];
    }
}
