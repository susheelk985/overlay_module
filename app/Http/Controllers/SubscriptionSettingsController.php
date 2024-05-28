<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionSettings;
use Illuminate\Http\Request;


class SubscriptionSettingsController extends Controller
{
    public function index()
    {
        $settings = SubscriptionSettings::first();
        return view('admin.subscription_settings', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'targeting_rule' => 'required|string',
            'overlay_type' => 'required|string',
            'display_rule' => 'required|string',
        ]);

        SubscriptionSettings::updateOrCreate(['id' => 1], $data);

        return redirect()->route('subscription.settings')->with('success', 'Settings updated successfully!');
    }
}
