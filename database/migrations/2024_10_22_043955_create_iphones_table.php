<?php

use App\Models\User;
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
        Schema::create('iphones', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('seri')->nullable();
            $table->string('imei')->nullable();
            $table->enum('jenis',['Pro','Pro XL','Non-Pro'])->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('harga')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iphones');
    }
};
