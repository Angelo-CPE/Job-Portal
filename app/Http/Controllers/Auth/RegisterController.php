<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'user_type' => 'required|in:applicant,employer',
            'company_name' => 'required_if:user_type,employer|max:255',
            'description' => 'required_if:user_type,employer|max:1000',
            'website' => 'nullable|url',
            'contact_number' => 'nullable|string|max:20',
        ]);

        // dd($credentials);

        // Check if email already exists
        if (User::where('email', $credentials['email'])->exists()) {
            return back()->withErrors(['email' => 'This email is already registered.'])->withInput();
        }

        // Create the user and save the selected user_type
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'user_type' => $credentials['user_type'],
        ]);

        // Create company if user is an employer
        if ($credentials['user_type'] === 'employer') {
            $company = new Company([
                'user_id' => $user->id,
                'company_name' => $credentials['company_name'],
                'description' => $credentials['description'],
                'website' => $credentials['website'],
                'contact_number' => $credentials['contact_number'],
            ]);
            $company->save();
        }

        // Trigger registration event and log in
        event(new Registered($user));
        Auth::login($user);

        // Send email verification
        $user->sendEmailVerificationNotification();

        return redirect()->route('home');
    }
}