<?php

namespace App\Services;

use App\Interfaces\SprayingInterface;
use App\Models\Spraying;
use Illuminate\Support\Collection;

class SprayingsService
{
    /**
     * @var SprayingInterface
     */
    protected $repository;

    /**
     * Constructor
     * @param SprayingInterface $repository
     */
    public function __construct(SprayingInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * Returns merged collection of sprayings
     * @return Collection
     */
    public function getMergedSprayings(): Collection
    {
        return $this->repository->allMerged();
    }

    /**
     * Create s Spraying
     * @param array $data
     * @return Spraying
     */
    public function createSpraying(array $data): Spraying
    {
        return $this->repository->create($data);
    }

    /**
     * Update a Spraying
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSpraying(int $id, array $data): bool
    {
        try {
            $spraying = $this->repository->findById($id);
            return $this->repository->update($spraying, $data);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Delete a Spraying
     * @param int $id
     * @return bool
     */
    public function deleteSpraying(int $id): bool
    {
        try{
            $spraying = $this->repository->findById($id);
            return $this->repository->delete($spraying);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
