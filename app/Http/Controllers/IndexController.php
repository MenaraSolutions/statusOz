<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Subject;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $viewVariables =[
            'subjectGroups' => Subject::all()->groupBy('group'),
            'subjects' => Subject::all()
        ];

        $response = new Response(view('index', $viewVariables));

        return $response;
    }
}
