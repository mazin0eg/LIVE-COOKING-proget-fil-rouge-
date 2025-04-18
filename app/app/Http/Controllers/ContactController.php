<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function showContactForm()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission
     */
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'is_chef_application' => 'boolean',
            'experience' => 'nullable|string|max:255',
            'speciality' => 'nullable|string|max:255',
        ]);

        $isChefApplication = $request->has('is_chef_application') && $request->is_chef_application == 1;

        // If user is logged in and this is a chef application, associate with user
        $userId = null;
        if ($isChefApplication && Auth::check()) {
            $userId = Auth::id();
        }

        $contact = Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_chef_application' => $isChefApplication,
            'status' => 'pending',
            'experience' => $request->experience,
            'speciality' => $request->speciality,
            'user_id' => $userId,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    /**
     * Approve a chef application
     */
    public function approveChef($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'approved';
        $contact->save();

        // If this application is associated with a user, update their role to chef
        if ($contact->user_id) {
            $user = User::find($contact->user_id);
            if ($user) {
                $user->role = 'chef';
                $user->save();
            }
        } else {
            // Try to find user by email
            $user = User::where('email', $contact->email)->first();
            if ($user) {
                $user->role = 'chef';
                $user->save();
            }
        }

        // Send email notification to the chef
        $this->sendApprovalEmail($contact);

        return redirect()->back()->with('success', 'Chef application has been approved!');
    }

    /**
     * Reject a chef application
     */
    public function rejectChef($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'rejected';
        $contact->save();

        return redirect()->back()->with('success', 'Chef application has been rejected!');
    }

    /**
     * Send approval email to chef
     */
    private function sendApprovalEmail($contact)
    {
        $data = [
            'name' => $contact->first_name . ' ' . $contact->last_name,
            'email' => $contact->email,
            'subject' => 'Your Chef Application Has Been Approved',
            'message' => 'Congratulations! Your application to become a chef at Platea has been approved.'
        ];

        Mail::send('emails.chef-approval', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
        });
    }
}
