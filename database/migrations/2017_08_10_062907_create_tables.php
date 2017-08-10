<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('id_number');
			$table->date('dob')->nullable();
			$table->string('password');
			$table->integer('group_id')->nullable();
			$table->boolean('admin')->default(false);
			$table->boolean('can_book')->default(true);
			$table->string('can_book_reason')->default('');
			$table->boolean('new_user')->default(true);
			$table->boolean('active')->default(true);
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('notes', function(Blueprint $table) {
			$table->increments('id');
			$table->mediumText('content');
			$table->integer('user_id');
			$table->integer('writer_id');
			$table->integer('revision_of')->nullable();
			$table->boolean('is_old');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('tutor', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('group_id');
			$table->timestamps();
		});

		Schema::create('password_resets', function (Blueprint $table) {
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at')->nullable();
		});

		Schema::create('group_types', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('groups', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code');
			$table->integer('group_type_id');
			$table->boolean('active')->default(true);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('product_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('product_type_id');
			$table->boolean('limitless')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('units', function(Blueprint $table) {
			$table->increments('id');
			$table->string('serial_number');
			$table->string('asset_number');
			$table->string('unit_number');
			$table->integer('product_id');
			$table->mediumText('notes');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('bookings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->timestamp('taken_at')->nullable();
			$table->timestamp('pickup_at')->nullable();
			$table->timestamp('closed_at')->nullable();
			$table->timestamp('due_at')->nullable();
			$table->timestamp('cancelled_at')->nullable();
			$table->integer('created_by_id');
			$table->integer('issued_by_id');
			$table->integer('closed_by_id')->nullable();
			$table->integer('cancelled_by_id');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('booking_product', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('booking_id');
			$table->integer('product_id');
			$table->integer('unit_id');
			$table->string('notes');
			$table->timestamp('returned_at')->nullable();
			$table->integer('returned_by_id')->nullable();
			$table->timestamps();
		});

		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('key'); // like a slug. eg, terms
			$table->string('label'); // this is the human readable name for the setting. eg, Terms And Conditions
			$table->mediumText('val'); // this is the value of the setting itself
			$table->string('field'); // this is the type of field you will use while editing
				// supported field values are:
				//  wysiwyg
				//  textarea
				//  text
				//  number
			$table->timestamps();
		});

		Schema::create('kits', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('kit_product', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kit_id');
			$table->integer('product_id');
			$table->integer('quantity');
		});

		Schema::create('group_type_product', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('group_type_id');
			$table->integer('product_id');
			$table->integer('quantity');
			$table->integer('days_allowed');
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
		Schema::drop('kits');
		Schema::drop('tutor');
		Schema::drop('users');
		Schema::drop('notes');
		Schema::drop('units');
		Schema::drop('groups');
		Schema::drop('products');
		Schema::drop('bookings');
		Schema::drop('settings');
		Schema::drop('kit_product');
		Schema::drop('group_types');
		Schema::drop('product_types');
		Schema::drop('password_resets');
		Schema::drop('booking_product');
		Schema::drop('group_type_product');
	}
}
