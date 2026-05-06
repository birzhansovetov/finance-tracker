<?php

namespace App\Http\Controllers;

use App\Mail\FileUploadedMail;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Show the send email form.
     */
    public function create()
    {
        $files = Auth::user()->files()->latest()->get();
        return view('finance.email', compact('files'));
    }

    /**
     * Send an email (optionally with a user file attached).
     */
    public function store(Request $request)
    {
        $request->validate([
            'to'      => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'file_id' => 'nullable|exists:user_files,id',
        ]);

        Mail::to($request->to)
    ->send(new \App\Mail\GenericMail(
        subject: $request->subject,
        body: $request->message,
        file: $request->file_id ? UserFile::find($request->file_id) : null,
    ));
\App\Models\SentEmail::create([
    'user_id' => Auth::id(),
    'to' => $request->to,
    'subject' => $request->subject,
    'body' => $request->message,
    'file_id' => $request->file_id,
]);

return redirect()->back()->with('success', 'Email sent successfully to ' . $request->to);
    }
    public function sent()
{
    $emails = \App\Models\SentEmail::where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('finance.email-sent', compact('emails'));
}

    /**
     * Notify a user about their uploaded file (called automatically after upload).
     */
    public static function notifyFileUploaded(UserFile $file): void
    {
        Mail::to($file->user->email)->send(new FileUploadedMail($file));
    }
}