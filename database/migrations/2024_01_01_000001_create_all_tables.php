<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->longText('content')->nullable();
            $table->timestamps();
        });
        Schema::create('principals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('designation', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('joining_date')->nullable();
            $table->text('message')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('eiin', 20)->nullable();
            $table->string('name_bn', 200)->nullable();
            $table->string('name_en', 200)->nullable();
            $table->string('village', 100)->nullable();
            $table->string('ward', 20)->nullable();
            $table->string('city_corp', 100)->nullable();
            $table->string('post_office', 100)->nullable();
            $table->string('post_code', 20)->nullable();
            $table->string('police_station', 100)->nullable();
            $table->string('upazila', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website', 200)->nullable();
            $table->integer('student_count')->nullable();
            $table->string('shift', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('land_area', 20)->nullable();
            $table->integer('buildings')->nullable();
            $table->integer('classrooms')->nullable();
            $table->integer('multimedia_rooms')->nullable();
            $table->integer('ict_labs')->nullable();
            $table->integer('science_labs')->nullable();
            $table->integer('library_rooms')->nullable();
            $table->string('has_auditorium', 10)->nullable();
            $table->string('has_boundary', 10)->nullable();
            $table->timestamps();
        });
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('village', 100)->nullable();
            $table->string('ward', 20)->nullable();
            $table->string('city_corp', 100)->nullable();
            $table->string('post_office', 100)->nullable();
            $table->string('post_code', 20)->nullable();
            $table->string('police_station', 100)->nullable();
            $table->string('upazila', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website', 200)->nullable();
            $table->text('map_embed')->nullable();
            $table->timestamps();
        });
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->date('publish_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_banner')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
        Schema::create('news_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300);
            $table->string('category', 100)->nullable();
            $table->string('file');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('caption', 200)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('pds_id', 20)->unique();
            $table->string('name', 150);
            $table->string('base_designation', 200)->nullable();
            $table->string('current_designation', 200);
            $table->date('joining_date')->nullable();
            $table->string('district', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
        Schema::create('student_data', function (Blueprint $table) {
            $table->id();
            $table->string('class', 20);
            $table->string('shift', 20)->default('Day');
            $table->string('section', 5)->nullable();
            $table->integer('total')->default(0);
            $table->integer('boys')->default(0);
            $table->integer('girls')->default(0);
            $table->integer('muslim')->default(0);
            $table->integer('hindu')->default(0);
            $table->integer('buddhist')->default(0);
            $table->integer('christian')->default(0);
            $table->integer('ff_science')->default(0);
            $table->integer('ff_general')->default(0);
            $table->integer('autistic')->default(0);
            $table->integer('physical')->default(0);
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('roll_no', 30)->nullable();
            $table->string('name_bn', 150);
            $table->string('name_en', 150)->nullable();
            $table->string('father_name', 150)->nullable();
            $table->string('mother_name', 150)->nullable();
            $table->string('father_occupation', 100)->nullable();
            $table->string('monthly_income', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('birth_cert_no', 50)->nullable();
            $table->string('class', 20)->nullable();
            $table->string('shift', 20)->default('Day');
            $table->string('section', 5)->nullable();
            $table->string('prev_school', 200)->nullable();
            $table->string('prev_class', 50)->nullable();
            $table->string('prev_result', 50)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('status', 20)->default('active');
            $table->string('academic_year', 10)->nullable();
            $table->text('transfer_note')->nullable();
            $table->timestamps();
            $table->index(['class', 'shift', 'section']);
            $table->index('status');
        });
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300);
            $table->string('exam_type', 50);
            $table->integer('year');
            $table->text('description')->nullable();
            $table->string('file');
            $table->timestamps();
            $table->index(['exam_type', 'year']);
        });
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('name_bn', 150);
            $table->string('name_en', 150)->nullable();
            $table->string('father_name', 150)->nullable();
            $table->string('mother_name', 150)->nullable();
            $table->string('father_occupation', 100)->nullable();
            $table->string('monthly_income', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('birth_cert_no', 50)->nullable();
            $table->string('applying_class', 5);
            $table->string('prev_school', 200)->nullable();
            $table->string('prev_class', 50)->nullable();
            $table->string('prev_result', 50)->nullable();
            $table->string('mobile', 20);
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
        Schema::dropIfExists('exam_results');
        Schema::dropIfExists('students');
        Schema::dropIfExists('student_data');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('downloads');
        Schema::dropIfExists('news_items');
        Schema::dropIfExists('notices');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('abouts');
        Schema::dropIfExists('principals');
        Schema::dropIfExists('page_contents');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
