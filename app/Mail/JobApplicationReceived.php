<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class JobApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $sex;
    public $birthdate;
    public $address;
    public $school;
    public $phone;
    public $email;
    public $salary;
    public $time;
    public $resume;
    public $listingTitle;

    public function __construct(Application $application)
    {
        $this->name = $application->name;
        $this->sex = $application->sex;
        $this->birthdate = $application->birthdate;
        $this->address = $application->address;
        $this->school = $application->school;
        $this->phone = $application->phone;
        $this->email = $application->email;
        $this->salary = $application->salary;
        $this->time = $application->time;
        $this->resume = Storage::url($application->resume);
        $this->listingTitle = $application->listing->title;
    }

    public function build(){
        return $this->subject('New Job Application Received')
                    ->view('emails.job-application-received');
    }

}