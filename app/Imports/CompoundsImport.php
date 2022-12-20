<?php

namespace App\Imports;

use App\Models\Compound;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;



class CompoundsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param Collection $collection
     */

    public function model(array $row)
    {
        $compound = new Compound();
        $compound->name = $row['name'];
        $compound->city = $row['city'];
        $compound->address = $row['address'];
        $compound->property_owner_id  = auth('owner')->user()->id;
        $isSaved = $compound->save();
    }
    public function rules(): array
    {
        return [
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
