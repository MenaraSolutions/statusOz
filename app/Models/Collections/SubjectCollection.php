<?php

namespace App\Models\Collections;

use App\Contracts\SubjectsCollectionInterface;
use Illuminate\Database\Eloquent\Collection;
use Config;

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

    /**
     * @param $groupId
     * @param $timeRange
     * @return int
     */
    public function getAverageSpeed($groupId, $timeRange = false)
    {
        $timeRange = $timeRange ?: Config::get('app.time_range_current');
        $subjectGroup = $this->where('group', $groupId);
        $sum = 0;

        foreach ($subjectGroup as $subject) {
            $sum += $subject->getAverageSpeed($timeRange);
        }

        return count($subjectGroup) ? round($sum / count($subjectGroup), 2) : 0;
    }

    /**
     * @param $groupId
     * @param $timeRange
     * @return int
     */
    public function getStatus($groupId, $timeRange = false)
    {
        $timeRange = $timeRange ?: Config::get('app.time_range_current');
        $subjectGroup = $this->where('group', $groupId);

        $statuses = [];

        foreach ($subjectGroup as $subject) {
            $statuses[] = $subject->getStatus($timeRange);
        }

        if (in_array(Config::get('app.STATUS_FAULTY'), $statuses) || in_array(Config::get('app.STATUS_ISSUES'), $statuses))
            return Config::get('app.STATUS_ISSUES');

        return Config::get('app.STATUS_OK');
    }
}