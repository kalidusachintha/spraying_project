<?php
namespace App\Interfaces;

use App\Models\Spraying;

interface SprayingInterface
{
    public function create(array $data);
    public function update(Spraying $spraying, array $data);
    public function allMerged();
    public function findById(int $id);
    public function deleteByCommentAndDate(array $date);
}
