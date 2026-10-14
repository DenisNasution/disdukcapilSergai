# 🏛️ Disdukcapil Sergai — Website & CMS

Official website and Content Management System (CMS) for the **Department of Population and Civil Registration of Serdang Bedagai Regency, Indonesia**.

Built from scratch with **PHP + CodeIgniter 4**, MySQL, and vanilla JavaScript — complete with an admin panel to manage all website content.

---

## 📸 Preview

> <img width="1366" height="617" alt="fullpage_snapshot_localhost_2026-10-07-14-04-28" src="https://github.com/user-attachments/assets/fc329679-41f8-48b8-a010-920236126bb6" />
> - Homepage
> - Admin Dashboard
> - Mobile View

---

## ✨ Key Features

### 🌐 Public Website
- **Homepage** with carousel, statistics, activity gallery, and contact info
- **Department Profile** with dynamic sidebar navigation
- **Population Data** — population count, households, religion, education
- **Public Satisfaction Index** — quarterly satisfaction scores
- **Performance Assessment** — from Kemendagri, KemenPAN-RB, Ombudsman, and Itkab
- **Regulations** — Service Decrees & Legislation documents
- **Awards** — list of awards with certificate images
- **Requirements** — 57 requirement images with category dropdown
- **Innovation** — 3 innovation categories with image galleries
- **JADI TAU ADMINDUK** — complete service information
- **Q&A** — users can submit questions, admins can answer or reject
- **Complaints** — flow, facilities, and resolution timeline
- **Contact Us** — WhatsApp, Email, and location map (embedded Google Maps)
- **FAQ** — common questions with accordion layout

### 🔐 Admin Panel (CMS)
- **Secure login** with bcrypt password hashing, session regeneration, and brute-force lockout
- **Dashboard** with statistics for each menu
- **Full CRUD** for every menu (Create, Read, Update, Delete)
- **Secure image uploads** with MIME validation (finfo), random filenames, and automatic cleanup on failure
- **PDF uploads** for Regulations with strict validation
- **Responsive sidebar** with burger menu for mobile

---

## 🛠️ Tech Stack

| Layer | Technology |
| :--- | :--- |
| **Backend** | PHP 8.1+ · CodeIgniter 4 |
| **Database** | MySQL |
| **Frontend** | HTML5 · CSS3 · Vanilla JavaScript |
---

### Requirements
- PHP **8.1** or newer
- Composer
- MySQL / MariaDB
- XAMPP / Laragon

### Steps

**1. Clone this repository**
```bash
git clone https://github.com/USERNAME/disdukcapil-sergai.git
cd disdukcapil-sergai
```
**2. Install dependencies**
```bash
composer install
```
**3. Create the .env file**
```bash
cp env .env
```
**4. Configure the database in .env**
```ini
database.default.hostname = localhost
database.default.database = disdukcapil_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306

app.baseURL = 'http://localhost:8080/'
app.indexPage = ''
```
**5. Import the database**
```bash
mysql -u root -p disdukcapil_db < database.sql
```
**6. Create the first admin**
```bash
php spark make:admin admin YourStrongPassword "Admin Name"
```
**7. Start the server**
```bash
php spark serve
```

Visit the website at http://localhost:8080 and the admin panel at http://localhost:8080/admin/login.

