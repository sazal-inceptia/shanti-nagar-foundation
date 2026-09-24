<?php

namespace App\Services;

use App\Enums\DonorType;
use App\Models\Donor;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DonorService
{
    /**
     * Get list of donor types.
     */
    public function getDonorTypes(): array
    {
        return DonorType::options();
    }

    /**
     * Get paginated or filtered donors.
     */
    public function getDonors(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Donor::query()->withCount('donations')->with('donations');

        if (! empty($filters['donor_type'])) {
            $query->where('donor_type', $filters['donor_type']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    /**
     * Store a new Donor record.
     */
    public function store(array $data): Donor
    {
        return DB::transaction(function () use ($data) {
            $data['is_anonymous'] = ! empty($data['is_anonymous']);

            return Donor::create($data);
        });
    }

    /**
     * Update an existing Donor record.
     */
    public function update(Donor $donor, array $data): Donor
    {
        return DB::transaction(function () use ($donor, $data) {
            $data['is_anonymous'] = ! empty($data['is_anonymous']);
            $donor->update($data);

            return $donor;
        });
    }

    /**
     * Delete donor.
     */
    public function delete(Donor $donor): bool
    {
        return DB::transaction(function () use ($donor) {
            return (bool) $donor->delete();
        });
    }
}
