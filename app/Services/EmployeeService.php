<?php

namespace App\Services;

use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    /**
     * Get paginated employees with optional filtering.
     *
     * @param  array<string, mixed>  $filters
     */
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Employee::query()->with(['designation'])->withCount('salaries');

        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', (bool) $filters['is_active']);
        }

        if (! empty($filters['designation_id'])) {
            $query->where('designation_id', $filters['designation_id']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('designation', function ($dq) use ($search) {
                        $dq->where('name', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%");
                    });
            });
        }

        return $query->latest('id')->paginate($perPage);
    }

    /**
     * Store a newly created employee profile with photo upload support.
     *
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Employee
    {
        return DB::transaction(function () use ($data) {
            if (empty($data['employee_id'])) {
                $data['employee_id'] = $this->generateEmployeeId();
            }

            if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
                $path = $data['photo']->store('uploads/employees', 'public');
                $data['photo'] = 'storage/'.$path;
            }

            return Employee::create($data);
        });
    }

    /**
     * Update an existing employee profile.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Employee $employee, array $data): Employee
    {
        return DB::transaction(function () use ($employee, $data) {
            if (! empty($data['remove_photo'])) {
                if (! empty($employee->photo)) {
                    $oldPath = str_replace('storage/', '', $employee->photo);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $data['photo'] = null;
            } elseif (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
                // Delete old photo if present
                if (! empty($employee->photo)) {
                    $oldPath = str_replace('storage/', '', $employee->photo);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $path = $data['photo']->store('uploads/employees', 'public');
                $data['photo'] = 'storage/'.$path;
            }

            $employee->update($data);

            return $employee->fresh();
        });
    }

    /**
     * Soft delete an employee record.
     */
    public function delete(Employee $employee): bool
    {
        return DB::transaction(function () use ($employee) {
            return (bool) $employee->delete();
        });
    }

    /**
     * Generate next sequential employee ID (e.g., EMP-105).
     */
    public function generateEmployeeId(): string
    {
        $prefix = 'EMP-';

        $lastEmployee = Employee::withTrashed()
            ->where('employee_id', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('employee_id');

        if ($lastEmployee) {
            $lastNumber = (int) substr($lastEmployee, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 101;
        }

        return sprintf('%s%d', $prefix, $nextNumber);
    }

    /**
     * Get all active designations dynamically from database.
     *
     * @return Collection<int, Designation>
     */
    public function getDesignations(): Collection
    {
        return Designation::where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->get();
    }
}
