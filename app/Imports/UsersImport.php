<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use App\Models\User_Info;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::create([
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'status' => $row['status'],
                'is_verified' => $row['is_verified'],
            ]);

            $userInfo = User_Info::create([
                'user_id' => $user->id,
                'fullname' => $row['fullname'],
                'address' => $row['address'],
                'age' => $row['age'],
                'phone' => $row['phone'],
            ]);

            Role_User::create([
                'user_id' => $user->id,
                'role_id' => $row['role'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:users,email'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failures)
    {
    }
}
