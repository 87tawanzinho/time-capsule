<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Message;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "message" => "required|string",
            "date" => "nullable|date",
            "photos" => "nullable|string",
            "whatsapp_to" => "nullable|string|max:20",
            "email_address" => "nullable|email|max:255",
            "whatsapp_to_notifications_owner" => "nullable|string|max:20",
        ]);

        $message = Message::create($request->all());

        return response()->json($message, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
