<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages"; // Nome da tabela no banco de dados

    protected $fillable = [
        "name",
        "ownerName",
        "message",
        "date",
        "photo",
        "whatsapp_to",
        "email_address",
        "whatsapp_to_notifications_owner",
    ];

    protected $casts = [
        "date" => "datetime",
    ];
}
