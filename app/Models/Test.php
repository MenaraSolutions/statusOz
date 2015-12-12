<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Test extends Model
{
    /**
     * @var array
     */
    protected $dates = ['timestamp'];

    /**
     * @var array
     */
    protected $fillable = ['result', 'worker_id'];

    /**
     * When user is created
     */
    public static function boot() {
        parent::boot();

        static::saving(function($test) {
            $test->finished_at = Carbon::now();
        });
    }
}
