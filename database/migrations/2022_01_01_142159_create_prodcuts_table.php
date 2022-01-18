<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdcutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodcuts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->float('price');
            $table->string('image')->nullable();
            $table->enum('availibility', ['In Stock', 'Not Available'])->default('In Stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodcuts');
    }
}
