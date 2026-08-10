# গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল — Laravel 11 Website

## 📋 Laravel 11 Features Used
- **bootstrap/app.php** — New slim application bootstrap
- **AdminMiddleware** — Registered via `withMiddleware()` in bootstrap/app.php
- **AppServiceProvider** — View composer shares `$principal` & `$settings` globally
- **Single migration file** — All tables in one optimized migration
- `is_admin` field on **User model** for role-based access control

## ✅ Complete Features

### Frontend
- BD Flag left/right stripes (fixed position)
- Bangladesh Map watermark background (SVG, 4.5% opacity)
- Header: Banner image with school name/logo overlay (or gradient fallback)
- Sticky navigation with full dropdown menus
- শিক্ষার্থী — 2 sub-menus: সংখ্যা + তালিকা
- Exam Results with type tabs + year/search filter
- Full Admission form with photo preview
- Gallery with lightbox
- Fully responsive (mobile-first)

### Admin Panel
- Secure login with `is_admin` guard
- Dashboard with stats cards
- Complete Config page (tabbed: school info, contact, principal, logo/banner, history, APA, Sudhachar)
- Notice Board (CRUD + file upload + banner toggle)
- নোটিশ টিকার / News CRUD
- Downloads CRUD
- Gallery CRUD
- Teachers CRUD (with photo)
- শিক্ষার্থীর সংখ্যা (aggregate counts per class/shift/section)
- শিক্ষার্থীর তালিকা (individual records: CRUD + active/inactive + transfer modal + CSV export)
- Exam Results (CRUD + filters + file upload)
- Admission Applications (view + status change + CSV export)
- Settings (logo, banner upload)

## 🚀 ইনস্টলেশন

### Requirements
- PHP >= 8.2
- Composer
- MySQL >= 5.7 or MariaDB

### Steps

```bash
# 1. Extract and enter directory
cd govlab-school

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env
# DB_DATABASE=govlab_school
# DB_USERNAME=root
# DB_PASSWORD=your_password

# 5. Create database
# mysql -u root -p -e "CREATE DATABASE govlab_school CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 6. Run migrations + seed
php artisan migrate
php artisan db:seed

# 7. Create storage symlink
php artisan storage:link

# 8. Start server
php artisan serve
```

### Admin Login
- URL: `http://localhost:8000/admin`
- Email: `admin@govlab.edu.bd`
- Password: `admin123`

## 📁 Project Structure

```
govlab-school/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ← 12 admin controllers
│   │   │   └── Frontend/       ← 2 frontend controllers
│   │   └── Middleware/
│   │       └── AdminMiddleware.php  ← is_admin check
│   ├── Models/                 ← 14 Eloquent models incl. User
│   └── Providers/
│       └── AppServiceProvider.php  ← Global view composer
├── bootstrap/
│   └── app.php                 ← Laravel 11 slim bootstrap
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000001_create_all_tables.php  ← Single file
│   └── seeders/
│       └── DatabaseSeeder.php  ← Full demo data
├── public/
│   ├── css/frontend.css        ← Optimized responsive CSS
│   ├── css/admin.css           ← Admin panel CSS
│   ├── js/frontend.js          ← Minimal vanilla JS
│   └── js/admin.js             ← Admin JS with modals
├── resources/views/
│   ├── layouts/
│   │   ├── frontend.blade.php  ← Main layout with BD flag/map
│   │   └── admin.blade.php     ← Admin layout
│   ├── frontend/pages/         ← 13 frontend pages
│   └── admin/
│       ├── login.blade.php
│       └── pages/              ← 25+ admin pages
└── routes/
    ├── web.php                 ← All routes
    └── console.php             ← Laravel 11 required
```

## 🔑 Important Routes

| URL | Route Name | Description |
|-----|-----------|-------------|
| `/` | home | হোমপেজ |
| `/students/count` | students.count | শিক্ষার্থীর সংখ্যা |
| `/students/list` | students.list | শিক্ষার্থীর তালিকা |
| `/results` | results | পরীক্ষার ফলাফল |
| `/admission/apply` | admission.apply | ভর্তি আবেদন |
| `/admin/dashboard` | admin.dashboard | অ্যাডমিন ড্যাশবোর্ড |
| `/admin/config` | admin.config | সম্পূর্ণ কনফিগ (tabbed) |
| `/admin/student-records` | admin.student-records.index | শিক্ষার্থী তালিকা |

## 🛠️ Customization

### Add new admin user via tinker:
```bash
php artisan tinker
App\Models\User::create(['name'=>'Editor','email'=>'editor@school.bd','password'=>bcrypt('password'),'is_admin'=>true]);
```

### Change school logo/banner:
Admin Panel → সাইট সেটিংস → লোগো/ব্যানার আপলোড
