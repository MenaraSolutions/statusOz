<?php

namespace App\Models;

use App\Contracts\TestableSubjectInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections\SubjectCollection;

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
