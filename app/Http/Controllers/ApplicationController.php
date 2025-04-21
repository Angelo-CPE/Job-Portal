<?php

namespace App\Http\Controllers;

use App\Mail\JobApplicationReceived;
use App\Models\Application;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    /**
     * Show the application form for the listing.
     */
    public function create(Listing $listing)
    {
        return Inertia::render('Listing/Apply', [
            'listing' => $listing
        ]);
    }

    /**
     * Store a new job application.
     */
    public function store(Request $request, Listing $listing)
    {
        // Ensure the user is authenticated
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply.');
        }

        // Validate the form inputs
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'address' => ['required', 'string'],
            'school' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'salary' => ['required', 'numeric'],
            'time' => ['required', 'string'],
            'message' => ['nullable', 'string'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);


        // Store the resume file in the 'resumes' folder
        $resumePath = Storage::disk('public')->put('resumes', $request->file('resume'));

        // Create the application in the database
        $application = $request->user()->applications()->create([
            'listing_id' => $listing->id,
            'resume' => $resumePath,
            'message' => $validated['message'] ?? null,
            'name' => $validated['name'],
            'sex' => $validated['sex'],
            'birthdate' => $validated['birthdate'],
            'address' => $validated['address'],
            'school' => $validated['school'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'salary' => $validated['salary'],
            'time' => $validated['time'],
        ]);

        // dd($application);

        // Send an email to confirm the job application
        $application->load('listing');

        Mail::to($request->user()->email)->send(new JobApplicationReceived($application));


        // Redirect back with a success message
        return redirect()->route('dashboard')->with('status', 'Application submitted successfully!');
    }
}