<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create("messages", function (Blueprint $table) {
            $table->id();
            $table->string("name"); // Nome do remetente
            $table->string("ownerName")->nullable();
            $table->text("message"); // Mensagem enviada
            $table->timestamp("date")->nullable(); // Data do envio
            $table->string("photo")->nullable();
            $table->string("whatsapp_to")->nullable(); // WhatsApp do destinatário (se vazio, não envia)
            $table->string("email_address")->nullable(); // E-mail do destinatário (se vazio, não envia)
            $table->string("whatsapp_to_notifications_owner")->nullable(); // WhatsApp para notificações (se vazio, não notifica)
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("messages");
    }
};
