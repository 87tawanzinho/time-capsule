<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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

    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            "name" => "required|string|max:255",
            "message" => "required|string",
            "date" => "nullable|date",
            "photo" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "whatsapp_to" => "nullable|string|max:20",
            "email_address" => "nullable|email|max:255",
            "whatsapp_to_notifications_owner" => "nullable|string|max:20",
        ]);

        // Se houver uma foto, armazena no storage e obtém o caminho
        $photoPath = $request->hasFile("photo")
            ? $request->file("photo")->store("photos", "public")
            : null;

        // Criar o payload para enviar ao webhook
        $payload = [
            "name" => $request->name,
            "ownerName" => $request->ownerName,
            "message" => $request->message,
            "date" => $request->date,
            "photo" => $photoPath,
            "whatsapp_to" => $request->whatsapp_to,
            "email_address" => $request->email_address,
            "whatsapp_to_notifications_owner" =>
                $request->whatsapp_to_notifications_owner,
        ];

        // Criando instância do Axios (Guzzle)
        $client = new Client();

        try {
            // Enviando os dados para o webhook via Axios (Guzzle)
            $response = $client->post(
                "https://n8n.amoremfotos.com.br/webhook/goMany",
                [
                    "json" => $payload,
                    "headers" => [
                        "Accept" => "application/json",
                        "Content-Type" => "application/json",
                    ],
                ]
            );

            return response()->json(
                [
                    "message" => "Dados enviados com sucesso.",
                    "response" => json_decode($response->getBody(), true),
                ],
                200
            );
        } catch (RequestException $e) {
            return response()->json(
                [
                    "message" => "Erro ao conectar com o webhook.",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
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
