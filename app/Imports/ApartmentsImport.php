<?php

namespace App\Imports;

use App\Models\Apartment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ApartmentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $apartment = new Apartment();
        $apartment->kind = $row['kind'];
        $apartment->apartment_name = $row['apartment_name'];
        $apartment->apartment_date_added = $row['apartment_date_added'];
        $apartment->city = $row['city'];
        $apartment->address = $row['address'];
        $apartment->space = $row['space'];
        $apartment->ac_type = $row['ac_type'];
        $apartment->floor_number = $row['floor_number'];
        $apartment->number_of_bedrooms = $row['number_of_bedrooms'];
        $apartment->number_of_bathrooms = $row['number_of_bathrooms'];

        $apartment->number_of_councils = $row['number_of_councils'];
        $apartment->number_of_lounges = $row['number_of_lounges'];
        $apartment->furnishing_condition = $row['furnishing_condition'];

        $apartment->type_of_kitchen = $row['type_of_kitchen'];
        $apartment->parking = $row['parking'];
        $apartment->electricity_meter_number = $row['electricity_meter_number'];
        $apartment->water_meter_number = $row['water_meter_number'];
        $apartment->building_id = $row['building_id'];
        $apartment->compound_id = $row['compound_id'];
        $apartment->property_owner_id  = auth('owner')->user()->id;
        $isSaved = $apartment->save();
    }
    public function rules(): array
    {
        return [
            '*.kind' => 'required',
            '*.apartment_name' => 'required',
            '*.city' => 'required',
            '*.address' => 'required',
            '*.space' => 'required',
        ];
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
