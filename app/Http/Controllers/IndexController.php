<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Subject;

class IndexController extends Controller
{
    /**
     * Display the index page
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return new Response(view('index', [
            'subjectGroups' => Subject::all()->groupBy('group'),
            'subjects' => Subject::all()
        ]));
    }
}
