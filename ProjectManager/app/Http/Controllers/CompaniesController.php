<?php
namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CompaniesController extends Controller
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
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.index', ['companies'=>$companies]);
        }
        return view('auth.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.create');
        }
        return view('auth.login');
        //return view('companies.create');
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
            $company=Company::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'user_id'=>Auth::user()->id
            ]);
            if ($company) {
                return redirect()->route('companies.show',['company'=>$company->id])->with('success','Company created succesfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new company');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        //$company = Company::where('id',$company->id)->first();
        if (Auth::check()) {
            $company = Company::find($company->id);
            return view('companies.show', ['company'=>$company]);
        }
        return view('auth.login');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        if (Auth::check()) {
            $company = Company::find($company->id);
            return view('companies.edit', ['company'=>$company]);
        }
        return view('auth.login');
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if (Auth::check()) {
            //Save data
            $companyUpdate=Company::where('id',$company->id)->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
            ]);
            if ($companyUpdate) {
                return redirect()->route('companies.show', ['company'=>$company->id])->with('success','Company updated succesfully');
            }
            //redirect
            return back()->withInput();
        }
        return view('auth.login');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
        if (Auth::check()) {
            $findCompany= Company::find($company->id);
            if ($findCompany->delete()) {
                //redirect
                return redirect()->route('companies.index')->with('success', 'Company deleted Succesfully');
            }
            return back()->withInput()->with('error', 'Company could not be deleted');
        }
        return view('auth.login');
        
    }
}