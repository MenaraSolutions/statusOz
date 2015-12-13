<?php

namespace App\Models;

use App\Contracts\TestableSubjectInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections\SubjectCollection;
use Config;

class Subject extends Model implements TestableSubjectInterface
{
    /**
     * @return mixed
     */
    public function getTesterParameter()
    {
        return $this->settings['tester_parameter'];
    }

    /**
     * @return array
     */
    protected function getMonthlyStatistics()
    {
        $minimumDate = date('Y-m-d H:i:s', strtotime('-1 month'));

        $tests = $this->tests()->where('finished_at', '>=', $minimumDate)->get()->transform(function ($item, $key) {
            return $item->result;
        });

        return [
            'average' => $tests->avg(),
            'deviation' => $this->getStandardDeviation($tests->toArray())
        ];
    }

    /**
     * This shouldn't be here but Laravel doesn't have a wrapper for MySQL STD() query :(
     *
     * This user-land implementation follows the implementation quite strictly;
     * it does not attempt to improve the code or algorithm in any way. It will
     * raise a warning if you have fewer than 2 values in your array, just like
     * the extension does (although as an E_USER_WARNING, not E_WARNING).
     *
     * @param array $a
     * @param bool $sample [optional] Defaults to false
     * @return float|bool The standard deviation or false on error.
     */
    protected function getStandardDeviation(array $a, $sample = false)
    {
        $n = count($a);

        if ($n === 0) {
            return false;
        }

        if ($sample && $n === 1) {
            return false;
        }

        $mean = array_sum($a) / $n;
        $carry = 0.0;

        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };

        if ($sample) {
            --$n;
        }

        return sqrt($carry / $n);
    }

    /**
     * @param $timeRange
     * @return mixed
     */
    public function getStatus($timeRange = false)
    {
        $timeRange = $timeRange ?: Config::get('app.time_range_current');

        $averageSpeed = $this->getAverageSpeed($timeRange);
        $statistics = $this->getMonthlyStatistics();

        // Two standard deviations mean everything is great
        if ($averageSpeed >= $statistics['average'] - ($statistics['deviation'] * 2)) {
            return Config::get('app.STATUS_OK');
        }

        // Four standard deviations mean there are moderate issues
        if ($averageSpeed >= $statistics['average'] - ($statistics['deviation'] * 4)) {
            return Config::get('app.STATUS_ISSUES');
        }

        return Config::get('app.STATUS_FAULTY');
    }

    /**
     * @param $timeRange
     *
     * @return float
     */
    public function getAverageSpeed($timeRange = false)
    {
        $timeRange = $timeRange ?: Config::get('app.time_range_current');
        $minimumDate = date('Y-m-d H:i:s', time() - $timeRange);

        return $this->tests()->where('finished_at', '>=' , $minimumDate)->get()->average('result');
    }

    /**
     * Tests taken for this subject
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany('App\Models\Test');
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new SubjectCollection($models);
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];
}
