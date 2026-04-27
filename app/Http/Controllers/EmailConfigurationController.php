<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
use Illuminate\Http\Request;

class EmailConfigurationController extends Controller
{
    public function index()
    {
        $settings = WebsiteContent::where('group', 'email_config')->get()->keyBy('key');

        return view('admin.email_config', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'is_smtp' => 'required|boolean',
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|string',
            'smtp_user' => 'required|string',
            'smtp_pass' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
        ]);

        foreach ($data as $key => $value) {
            WebsiteContent::updateOrCreate(
                ['key' => $key, 'group' => 'email_config'],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Email configuration updated successfully.');
    }
}
