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
            $table->longText('homeQuote');
            $table->string('homeQuoteSource');
            $table->string('groomAddress');
            $table->string('brideAddress');
            $table->string('groomName');
            $table->string('groomPhoto');
            $table->string('brideName');
            $table->string('bridePhoto');
            $table->string('groomFather');
            $table->string('groomMother');
            $table->string('brideFather');
            $table->string('brideMother');
            $table->string('musicBackground');
            $table->longText('mapEmbedUrl');
            $table->string('openingGreeting');
            $table->longText('welcomeMessage');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->string('eventLocation');
            $table->string('closingGreeting');
            $table->string('bankName1');
            $table->string('accountNumber1');
            $table->string('accountName1');
            $table->string('bankLogo1');
            $table->string('bankName2');
            $table->string('accountNumber2');
            $table->string('accountName2');
            $table->string('bankLogo2');
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
