<?php
namespace App\Interfaces;

use App\Models\Spraying;

interface SprayingInterface
{
    public function create(array $data);
    public function update(Spraying $spraying, array $data);
    public function delete(Spraying $spraying);
    public function allMerged();
    public function findById(int $id);
}
