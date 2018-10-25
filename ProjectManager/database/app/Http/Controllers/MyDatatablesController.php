<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use yajra\Datatables\Datatables;

use App\Company;
use App\Project;

class MyDatatablesController extends Controller

{

	/**

     * Displays front end view

     *

     * @return \Illuminate\View\View

     */

    public function index()

    {

    	return view('datatables');

    }

    /**

     * Process ajax request.

     *

     * @return \Illuminate\Http\JsonResponse

     */

    public function getData()

    {

        return Datatables::of(Company::query())->make(true);

    }
 public function getProject()

    {

        return Datatables::of(Project::query())->make(true);

    }



}