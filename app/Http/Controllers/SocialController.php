<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $name => $url) {
            Social::updateOrCreate(
                ['name' => $name],
                ['url' => $url]
            );
        }

        return redirect()->back()->with('success', 'Social media information updated successfully.');
    }
}
