<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                    ->constrained()
                    ->onDelete('cascade');
        
            $table->enum('type', ['simple', 'variable']);


            $table->string('name');
            $table->string('slug', 100)->unique();

            $table->text('excerpt');
            $table->longText('description')->nullable();

            $table->string('unit');
            $table->unsignedInteger('quantity')->nullable();

            $table->float('price', 8, 2)->nullable();
            $table->float('discount', 8, 1)->nullable();

            $table->boolean('is_popular')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_flash_sale')->default(false);
            $table->boolean('is_spacial')->default(false);
           

            $table->json('variations')->nullable();

            $table->string('meta_title')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->enum('stock_status', ['in_stock', 'low', 'out_of_stock']);
            $table->boolean('status')->default(false);

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
        Schema::dropIfExists('products');
    }
}
