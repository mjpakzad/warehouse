<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Show the form for uploading products.json and articles.json files.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.index');
    }

    /**
     * Process products and articles json files.
     *
     * @param  \App\Http\Requests\AppRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function process(AppRequest $request)
    {
        //
    }
}
