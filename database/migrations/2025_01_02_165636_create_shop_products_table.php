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
        Schema::create('shop_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code', 50);
            $table->text('product_name', 500);
            $table->text('image');
            $table->text('short_desciption', 250);
            $table->mediumText('desciption');
            $table->decimal('standard_cost', 16, 0);
            $table->decimal('list_price', 16, 0);
            $table->integer('quantity_per_unit');
            $table->boolean('discontinued');
            $table->boolean('is_featured');
            $table->boolean('is_new');
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('shop_suppliers');
            $table->foreign('category_id')->references('id')->on('shop_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
