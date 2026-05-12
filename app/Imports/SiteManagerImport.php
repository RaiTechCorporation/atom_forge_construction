<?php

namespace App\Imports;

use App\Models\SiteManager;
use App\Models\User;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiteManagerImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $projects;
    protected $supervisorRole;

    public function __construct()
    {
        $this->projects = Project::pluck('id', 'name');
        $this->supervisorRole = Role::where('slug', 'site_supervisor')->first() ?? Role::where('slug', 'admin')->first();
    }

    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {
            $projectId = null;
            if (!empty($row['project'])) {
                $projectId = $this->projects[$row['project']] ?? null;
            }

            // Check if user already exists
            $user = User::where('email', $row['email'])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => Hash::make('password123'), // Default password
                    'role' => 'site_supervisor',
                ]);

                if ($this->supervisorRole) {
                    $user->roles()->attach($this->supervisorRole->id);
                }
            }

            return new SiteManager([
                'user_id'                    => $user->id,
                'name'                       => $row['name'],
                'email'                      => $row['email'],
                'phone'                      => $row['phone'] ?? null,
                'father_name'                => $row['father_name'] ?? null,
                'current_address'            => $row['current_address'] ?? null,
                'permanent_address'          => $row['permanent_address'] ?? null,
                'city'                       => $row['city'] ?? null,
                'state'                      => $row['state'] ?? null,
                'pincode'                    => $row['pincode'] ?? null,
                'qualification'              => $row['qualification'] ?? null,
                'tenth_passing_year'         => $row['10th_passing_year'] ?? null,
                'tenth_percentage'           => $row['10th_percentage'] ?? null,
                'tenth_board'                => $row['10th_board'] ?? null,
                'twelfth_passing_year'       => $row['12th_passing_year'] ?? null,
                'twelfth_percentage'         => $row['12th_percentage'] ?? null,
                'twelfth_board'              => $row['12th_board'] ?? null,
                'graduation_passing_year'    => $row['graduation_passing_year'] ?? null,
                'graduation_percentage'      => $row['graduation_percentage'] ?? null,
                'graduation_university'      => $row['graduation_university'] ?? null,
                'experience'                 => $row['experience'] ?? null,
                'project_id'                 => $projectId,
                'salary_amount'              => $row['salary_amount'] ?? null,
                'salary_type'                => $row['salary_type'] ?? 'Monthly',
                'aadhaar_number'             => $row['aadhaar_number'] ?? null,
                'pan_number'                 => $row['pan_number'] ?? null,
                'emergency_contact_name'     => $row['emergency_contact_name'] ?? null,
                'emergency_contact_number'   => $row['emergency_contact_number'] ?? null,
                'joining_date'               => $row['joining_date'] ?? null,
                'status'                     => $row['status'] ?? 'Active',
                'remarks'                    => $row['remarks'] ?? null,
            ]);
        });
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Phone might be nullable but better to validate if present
            'phone' => 'nullable|string|max:20',
        ];
    }
}
