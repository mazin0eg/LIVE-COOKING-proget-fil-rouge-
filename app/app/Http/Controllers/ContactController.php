<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        // Validate the basic fields
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'is_chef_application' => 'boolean',
            'experience' => 'nullable|string|max:255',
            'speciality' => 'nullable|string|max:255',
            'chef_reason' => 'nullable|string',
        ]);

        $isChefApplication = $request->has('is_chef_application') && $request->is_chef_application == 1;

        // Additional validation for chef applications
        if ($isChefApplication) {
            $request->validate([
                'experience' => 'required|string|max:255',
                'speciality' => 'required|string|max:255',
                'chef_reason' => 'required|string',
            ]);
            
            // Check if user is logged in
            if (!Auth::check()) {
                return redirect()->back()->with('error', 'You must be logged in to apply as a chef.')->withInput();
            }
            
            // Check if user is already a chef
            if (Auth::check() && Auth::user()->role === 'chef') {
                return redirect()->back()->with('info', 'You are already approved as a chef!')->withInput();
            }
        }

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

        try {
            // Send email notification to the admin
            $this->sendContactEmail($contact);
            
            // Send a copy to the submitter
            $this->sendConfirmationEmail($contact);
            
            return redirect()->back()->with('success', 'Your message has been sent successfully! A copy has been sent to your email.');
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email: ' . $e->getMessage());
            return redirect()->back()->with('success', 'Your message has been received. However, there was an issue sending the email confirmation.');
        }
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

        try {
            // Use Laravel's built-in Mail facade
            Mail::raw($data['message'], function($mail) use ($data) {
                $mail->to($data['email'], $data['name'])
                     ->from('mazin.zougui@gmail.com', 'CookNow')
                     ->subject($data['subject']);
            });
            
            \Log::info('Approval email sent successfully to ' . $data['email']);
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email: ' . $e->getMessage());
        }
    }

    /**
     * Send contact form email to admin
     */
    private function sendContactEmail($contact)
    {
        $subject = 'New Contact Form Submission: ' . $contact->subject;
        
        $message = "Name: {$contact->first_name} {$contact->last_name}\n";
        $message .= "Email: {$contact->email}\n";
        $message .= "Subject: {$contact->subject}\n\n";
        $message .= "Message:\n{$contact->message}\n\n";
        
        if ($contact->is_chef_application) {
            $message .= "This is a chef application.\n";
            $message .= "Experience: {$contact->experience}\n";
            $message .= "Speciality: {$contact->speciality}\n";
            if (!empty($contact->chef_reason)) {
                $message .= "Reason: {$contact->chef_reason}\n";
            }
            
            // Add user information if available
            if ($contact->user_id) {
                $user = User::find($contact->user_id);
                if ($user) {
                    $message .= "\nUser Information:\n";
                    $message .= "User ID: {$user->id}\n";
                    $message .= "Current Role: {$user->role}\n";
                    $message .= "Registered Since: {$user->created_at}\n";
                }
            }
        }

        // Use Laravel's built-in Mail facade
        Mail::raw($message, function($mail) use ($contact, $subject) {
            $mail->to('mazin.zougui@gmail.com', 'CookNow Admin')
                 ->from('mazin.zougui@gmail.com', 'CookNow')
                 ->subject($subject)
                 ->replyTo($contact->email, $contact->first_name . ' ' . $contact->last_name);
        });
        
        \Log::info('Contact email sent successfully to mazin.zougui@gmail.com');
    }
    
    /**
     * Send a confirmation email to the person who submitted the contact form
     *
     * @param Contact $contact
     * @return void
     */
    private function sendConfirmationEmail($contact)
    {
        $subject = 'Thank you for contacting CookNow: ' . $contact->subject;
        
        $message = "Dear {$contact->first_name} {$contact->last_name},\n\n";
        $message .= "Thank you for contacting CookNow. We have received your message and will get back to you as soon as possible.\n\n";
        $message .= "Here's a copy of your message for your records:\n\n";
        $message .= "Subject: {$contact->subject}\n";
        $message .= "Message:\n{$contact->message}\n\n";
        
        if ($contact->is_chef_application) {
            $message .= "You have applied to become a chef on our platform.\n";
            $message .= "We will review your application and get back to you soon.\n\n";
            $message .= "Experience: {$contact->experience}\n";
            $message .= "Speciality: {$contact->speciality}\n";
        }
        
        $message .= "\n\nBest regards,\n";
        $message .= "The CookNow Team";
        
        // Use Laravel's built-in Mail facade
        Mail::raw($message, function($mail) use ($contact, $subject) {
            $mail->to($contact->email, $contact->first_name . ' ' . $contact->last_name)
                 ->from('mazin.zougui@gmail.com', 'CookNow')
                 ->subject($subject);
        });
        
        \Log::info('Confirmation email sent to ' . $contact->email);
    }
}
