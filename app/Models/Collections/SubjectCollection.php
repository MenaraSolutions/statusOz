<?php

namespace App\Models\Collections;

use App\Contracts\SubjectsCollectionInterface;
use Illuminate\Database\Eloquent\Collection;

class SubjectCollection extends Collection implements SubjectsCollectionInterface
{
    /**
     * Return an array of subjects that should be processed by worker with given ID
     *
     * @param $workerId
     *
     * @return array
     */
    public function getSubjectsByWorkerId($workerId)
    {
        return $this->filter(function ($item) use ($workerId) {
            return in_array($workerId, $item->settings['workers']);
        });
    }

}