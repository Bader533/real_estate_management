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
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;



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
            '*.name' => 'required |string | max:18',
            '*.city' => 'required |string | max:18',
            '*.address' => 'required |string | max:30',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
