# Online Voting System

A web-based Online Voting System developed as a Final Year Project (BS Information Technology, GCUF) using **HTML, CSS, Bootstrap, JavaScript, PHP (PDO), and MySQL**. The platform enables registered voters—including overseas citizens—to sign up, log in, and cast their ballot securely using their CNIC or registered username, while providing administrators with a protected dashboard to review recorded votes.

---

## Features

- **Public Portal**
  - **Home (`Front-end-OES.php`)** — Overview of the online voting platform, security benefits, and workflow.
  - **Info (`info.php`)** — Information on voter eligibility, election setup, and ballot flow.
  - **Contact (`Contact.php`)** — Contact form that stores inquiries directly in the `contact` MySQL table.
- **Voter Authentication & Voting**
  - **Voter Registration (`registerationform.php`)** — Account signup with password hashing (`password_hash`) and optional profile picture upload (`usersimg/`).
  - **Voter Login (`loginFORM.php`)** — Session-based login against the `register` table.
  - **Voter Dashboard & Ballot (`index.php`, `voter.php`)** — Protected pages requiring an active voter session; enforces one vote per CNIC and records area, gender, and party choice in the `voter` table.
- **Admin Dashboard**
  - **Admin Login (`adminlogin.php`)** — Protected login against the `admin_login` table.
  - **Vote Records (`table.php`)** — DataTables-powered view displaying all recorded ballots with search, pagination, and export options.

---

## Tech Stack

- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript, jQuery, DataTables, Animate.css
- **Backend:** PHP 8+ (PDO with prepared statements)
- **Database:** MySQL / MariaDB (`bilal` database)
- **Local Server:** XAMPP (Apache + MySQL)

---

## Project Structure

```text
online-voting-system/
├── Front-end-OES.php       # Public landing page
├── info.php                # Election information page
├── Contact.php             # Contact page & form handler
├── registerationform.php   # Voter registration with image upload
├── loginFORM.php           # Voter login
├── index.php               # Voter dashboard (auth-protected)
├── voter.php               # Ballot submission form (auth-protected)
├── adminlogin.php          # Admin login
├── table.php               # Admin voter records table (auth-protected)
├── logout.php              # Session logout
├── conn/
│   └── conn.php            # PDO MySQL database connection
├── include/
│   ├── header.php          # Dashboard topbar
│   └── sidebar.php         # Dashboard navigation sidebar
├── database/
│   └── bilal.sql           # MySQL database schema & demo admin seed
├── css/                    # Custom & Bootstrap stylesheets
├── js/                     # Bootstrap & jQuery scripts
├── img/                    # Logo assets
└── assets/                 # Admin dashboard theme assets (CSS, JS, fonts, libs)
```

---

## Setup Instructions (XAMPP)

1. **Clone or download** this repository into your XAMPP `htdocs` directory (e.g., `C:\xampp\htdocs\online-voting-system`).
2. **Start Apache and MySQL** from the XAMPP Control Panel.
3. **Import the database:**
   - Open `http://localhost/phpmyadmin`.
   - Import `database/bilal.sql` (this creates the `bilal` database and tables: `admin_login`, `contact`, `login`, `register`, `voter`).
4. **Configure database connection** (if needed) in `conn/conn.php`:
   - Default local credentials: host `localhost`, database `bilal`, user `root`, password `""`.
5. **Open in browser:**
   - Public site: `http://localhost/online-voting-system/Front-end-OES.php`
   - Admin login: `http://localhost/online-voting-system/adminlogin.php` *(default demo credentials in `bilal.sql`: `admin` / `admin123` — change before deploying)*

---

## Authors

- **Faiq Hassan** — Project Presenter, Research & Documentation ([GitHub](https://github.com/ifaiqhassan1) · [LinkedIn](https://www.linkedin.com/in/faiq-hassan-))
- **Abdullah** — Co-developer
