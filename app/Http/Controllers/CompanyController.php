<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'website' => 'nullable|url',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $company = new Company([
            'user_id' => Auth::id(),
            'company_name' => $validated['company_name'],
            'description' => $validated['description'],
            'website' => $validated['website'],
            'contact_number' => $validated['contact_number'],
        ]);

        $company->save();

        return redirect()->route('dashboard')->with('success', 'Company registered successfully!');
    }
}