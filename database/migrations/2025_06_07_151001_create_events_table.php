<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('homeImage');
            $table->string('homeQuote');
            $table->string('homeQuoteSource');
            $table->string('groomNameDetail');
            $table->string('groomParentsDetail');
            $table->string('groomAddress');
            $table->string('brideNameDetail');
            $table->string('brideParentsDetail');
            $table->string('brideAddress');
            $table->string('webTitle');
            $table->string('groomName');
            $table->string('brideName');
            $table->string('groomParents');
            $table->string('brideParents');
            $table->string('bannerImage');
            $table->string('musicBackground');
            $table->string('mapEmbedUrl');
            $table->string('openingGreeting');
            $table->string('welcomeMessage');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->string('eventLocation');
            $table->string('eventAddress');
            $table->string('closingGreeting');
            $table->string('bankName1');
            $table->string('accountNumber1');
            $table->string('accountName1');
            $table->string('bankLogo1');
            $table->string('bankName2');
            $table->string('accountNumber2');
            $table->string('accountName2');
            $table->string('bankLogo2');
            $table->string('giftAddress');
            $table->string('recipientName');
            $table->string('recipientPhone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
