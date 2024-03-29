<?php

namespace App\Http\Controllers;

use App\Models\Link;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index(){
        return view('index');
    }

    public function shorten(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);
        $originalUrl = $request->input('url');
        $existingUrl = Link::where('original_url', $originalUrl)->first();

        if ($existingUrl) {
            return response()->json(['shortened_url' => $existingUrl->short_url]);
        }

        $shortUrl = config('app.url') . '/' . Str::random(6);

        Link::create([
            'original_url' => $originalUrl,
            'short_url' => $shortUrl,
        ]);

        return response()->json(['shortened_url' => $shortUrl]);
    }

    public function redirect($id)
    {

        $link = Link::where('id', $id)->firstOrFail();
        return redirect($link->original_url);

    }

    public function showJson(){
        $links = Link::all();
        if (!$links) {
            return response()->json(['error' => 'Links are empty in DB'], 404);
        }
        return response()->json($links, 200);
    }

}
