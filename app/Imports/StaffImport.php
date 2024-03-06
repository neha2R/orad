<?php

namespace App\Imports;

use App\Models\User;
use App\Services\ActionsService;
use App\Services\WhatsappService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StaffImport implements ToCollection, WithHeadingRow,WithValidation
{
    public function rules(): array
    {
        return [
            
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:30',
            'role' => 'required|numeric|min:0|max:1',
            'department' => 'required|numeric|min:3|max:7',
            'sub_department' => 'required|numeric|min:1|max:7',
            'job_type' => 'required|numeric|min:1|max:2',
            'senior_id' => 'nullable|numeric',
            'email' => 'required|email|unique:users,email',
            'mobilecode' => 'required|numeric|digits_between:1,4',
            'mobile' => 'required|digits:10|unique:users,mobile',
        ];
    }

    public function collection(Collection $rows)
    {
        $errorbag=collect();
        
        foreach ($rows as $row) {
            if (!User::where('mobile', $row['mobile'])->exists()) {
               
                // lead create variables 
                $registeruser=User::create([
                    'name'           => $row['name'],
                    'role'           => $row['role'] ? '2' : '3',
                    'department'     => $row['department'],
                    'sub_department' => $row['sub_department'],
                    'job_type'       => $row['job_type'],
                    'parent_id'      => $row['role'] ? $row['senior_id'] : 0,
                    'email'          => $row['email'],
                    'mobilecode'     => "+".(string)$row['mobilecode'],
                    'mobile'         => $row['mobile'],
                    'password'       => Hash::make($row['mobile']),
                    'user_type'      => '1',
                ]);
                

            }else{
                $message = $raw['mobile'] ." mobile number is already exists...";
                $errorbag->push($message);
            }
        }

        // insterting data in schedule table
        if ($errorbag->isEmpty()) {
            $errorbag->push( "Excel import successfully...");
        }else {
            $key = ['error'=>'Invalid excel sheet. please check'];
            throw new \Maatwebsite\Excel\Validators\ValidationException(
                \Illuminate\Validation\ValidationException::withMessages($key),
                $errorbag->toArray()
            );
        }
    }
}
