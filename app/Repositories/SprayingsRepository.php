<?php

namespace App\Repositories;

use App\Interfaces\SprayingInterface;
use App\Models\Spraying;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class SprayingsRepository implements SprayingInterface
{
    /**
     * Return sprayings with merging records
     * @return Collection
     */
    public function allMerged(): Collection
    {
        return DB::table('sprayings')
            ->select('id','date', 'comment', 'products')
            ->get()
            ->groupBy(function ($item) {
                return $item->date . '|' . $item->comment;//grouping records
            })
            ->map(function ($group) {
                return [
                    'id' => $group->first()->id,
                    'date' => $group->first()->date,
                    'comment' => $group->first()->comment,
                    'products' => collect($group)->flatMap(function ($item) {
                        return json_decode($item->products, true);
                    })->unique()->values()->all(),
                ];
            })
            ->values();
    }

    /**
     * Create a spraying
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Spraying
    {
        return Spraying::create($data);
    }

    /**
     * Update Spraying
     * @param Spraying $spraying
     * @param array $data
     * @return bool
     */
    public function update(Spraying $spraying, array $data): bool
    {
        return $spraying->update($data);
    }

    /**
     * Delete Spraying
     * @param Spraying $spraying
     * @return void
     */
    public function delete(Spraying $spraying): void
    {
        $spraying->delete();
    }

    /**
     * Find a spraying by id
     * @param int $id
     * @return Spraying
     */
    public function findById(int $id): Spraying
    {
        return Spraying::findOrFail($id);
    }

}
