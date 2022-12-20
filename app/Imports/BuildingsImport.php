<?php

namespace App\Imports;

use App\Models\Building;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class BuildingsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $building = new Building();
        $building->kind = $row['kind'];
        $building->name = $row['name'];
        $building->compound_id = $row['compound_id'];
        $building->city = $row['city'];
        $building->address = $row['address'];
        $building->property_owner_id  = auth('owner')->user()->id;
        $isSaved = $building->save();
    }
    public function rules(): array
    {
        return [
            '*.kind' => 'required',
            '*.name' => 'required',
            '*.city' => 'required',
            '*.address' => 'required',
        ];
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
