<?php

namespace App\Http\Controllers;

use App\Mail\FileUploadedMail;
use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Show the file manager page.
     */
    public function index()
    {
        $files = Auth::user()->files()->latest()->get();
        return view('finance.files', compact('files'));
    }

    /**
     * Store a newly uploaded file.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:10240', 
                'mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt,zip,csv',
            ],
        ]);

        $uploaded    = $request->file('file');
        $originalName = $uploaded->getClientOriginalName();
        $storedName  = Str::uuid() . '.' . $uploaded->getClientOriginalExtension();
        $path        = $uploaded->storeAs('user_files/' . Auth::id(), $storedName, 'local');

        $userFile = UserFile::create([
            'user_id'       => Auth::id(),
            'original_name' => $originalName,
            'stored_name'   => $storedName,
            'path'          => $path,
            'mime_type'     => $uploaded->getMimeType(),
            'size'          => $uploaded->getSize(),
        ]);

        // Send email notification to the user
        Mail::to(Auth::user()->email)->send(new FileUploadedMail($userFile));

        return redirect()->route('files.index')
            ->with('success', 'File "' . $originalName . '" uploaded successfully.');
    }

    /**
     * Download a file (only owner can download).
     */
    public function download(UserFile $file)
    {
        abort_unless($file->user_id === Auth::id(), 403, 'Access denied.');
        return Storage::disk('local')->download($file->path, $file->original_name);
    }

    /**
     * Delete a file.
     */
    public function destroy(UserFile $file)
    {
        abort_unless($file->user_id === Auth::id(), 403, 'Access denied.');

        Storage::disk('local')->delete($file->path);
        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'File deleted successfully.');
    }
}