<?php

namespace App\Imports;

use App\Models\Tenant;
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

class TenantsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{

    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param Collection $collection
     */

    public function model(array $row)
    {
        $tenant = new Tenant();
        $tenant->name = $row['name'];
        $tenant->email = $row['email'];
        $tenant->phone = $row['phone'];
        $tenant->property_owner_id  = auth('owner')->user()->id;
        $isSaved = $tenant->save();
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required | string | max:18',
            '*.email' => 'required | string | max:18',
            '*.phone' => 'required | numeric',
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
