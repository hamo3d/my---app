<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->double('price')->unsigned();
            $table->boolean('exist')->default(true);
            $table->integer('count')->default(0);

            // 2- foreign id
            $table->foreignId("category_id")->constrained()->restrictOnDelete();

            $table->timestamps();
            // عند sحذف اي عنصر يتم تخزينه هنا
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
