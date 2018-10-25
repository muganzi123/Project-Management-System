<?php
namespace App\Http\Controllers;
use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $projects = Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index', ['projects'=>$projects]);
        }
        return view('auth.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id=null)
    {
        //
        if (Auth::check()) {
            $companies=null;
            if (!$company_id) {
                $companies = Company::where('user_id',Auth::user()->id)->get();
            }
            return view('projects.create',['company_id'=>$company_id, 'companies'=>$companies]);
        }
        return view('auth.login');
        //return view('projects.create',['project_id'=>$id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {
            $project=Project::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'company_id'=>$request->input('company_id'),
                'user_id'=>Auth::user()->id
            ]);
            flash('Project created succesfully','success');
        }
        return back()->withInput()->with('errors', 'Error creating new project');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        //$project = Project::where('id',$project->id)->first();
        if (Auth::check()) {
            $project = Project::find($project->id);
            $comments = $project->comments;
            return view('projects.show', ['project'=>$project,'comments'=>$comments]);
        }
        return view('auth.login');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit', ['project'=>$project]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //Save data
        $projectUpdate=Project::where('id',$project->id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);
        flash('Project Updated succesfully','success');
        //redirect
        return back()->withInput();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $findproject= Project::find($project->id);
        flash('Project deleted succesfully','success');
        return back()->withInput()->with('error', 'project could not be deleted');
    }
}