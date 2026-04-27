<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class GroupEmailController extends Controller
{
    public function index()
    {
        return view('admin.group_email');
    }

    public function send(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $this->setMailConfig();

        $users = [];
        if ($request->type === 'all') {
            $users = User::all();
        } else {
            $users = User::where('role', $request->type)->get();
        }

        if (count($users) > 0) {
            foreach ($users as $user) {
                Mail::html($request->body, function ($message) use ($user, $request) {
                    $message->to($user->email)
                        ->subject($request->subject);
                });
            }

            return redirect()->back()->with('success', 'Group email sent successfully to '.count($users).' users.');
        }

        return redirect()->back()->with('error', 'No users found for the selected type.');
    }

    private function setMailConfig()
    {
        $settings = WebsiteContent::where('group', 'email_config')->get()->keyBy('key');

        if (isset($settings['is_smtp']) && $settings['is_smtp']->value == '1') {
            Config::set('mail.mailers.smtp.host', $settings['smtp_host']->value ?? config('mail.mailers.smtp.host'));
            Config::set('mail.mailers.smtp.port', $settings['smtp_port']->value ?? config('mail.mailers.smtp.port'));
            Config::set('mail.mailers.smtp.username', $settings['smtp_user']->value ?? config('mail.mailers.smtp.username'));
            Config::set('mail.mailers.smtp.password', $settings['smtp_pass']->value ?? config('mail.mailers.smtp.password'));
            Config::set('mail.from.address', $settings['from_email']->value ?? config('mail.from.address'));
            Config::set('mail.from.name', $settings['from_name']->value ?? config('mail.from.name'));
        }
    }
}
