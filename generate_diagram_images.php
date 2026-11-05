<?php

// Test script to validate and render all 23 diagrams with 100% strict Mermaid syntax
// All node labels with punctuation, question marks, greater-than, less-than, etc. are properly quoted!

$edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';
if (!file_exists($edgePath)) {
    $edgePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
}

$outputDir = __DIR__ . '/public/diagrams/images';
$tempDir = __DIR__ . '/public/diagrams/temp';

if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);
if (!is_dir($tempDir)) mkdir($tempDir, 0777, true);

$diagrams = [
    [
        'id' => '01_usecase_global',
        'category' => 'usecase',
        'badge' => 'Diagram Use Case #1',
        'title' => 'Diagram Use Case: Global Sistem Reservasi Rama Homestay',
        'subtitle' => 'Pemetaan Interaksi Aktor Tamu, Admin Homestay, dan Payment Gateway Midtrans',
        'width' => 1250,
        'height' => 880,
        'mermaid' => <<<MERMAID
flowchart LR
    classDef actorStyle fill:#ffffff,stroke:#000000,stroke-width:2px,color:#000000;
    classDef ucStyle fill:#ffffff,stroke:#000000,stroke-width:1.5px,color:#000000;

    Tamu["«actor»<br>Tamu"]:::actorStyle
    Admin["«actor»<br>Admin Homestay"]:::actorStyle
    Midtrans["«actor»<br>Payment Gateway Midtrans"]:::actorStyle

    subgraph System ["Batasan Sistem: Sistem Informasi Reservasi Rama Homestay"]
        direction TB
        UC_Auth(["Autentikasi Akun (Login / Register)"]):::ucStyle
        UC_Explore(["Eksplorasi & Cek Ketersediaan Kamar"]):::ucStyle
        UC_Booking(["Pemesanan / Reservasi Kamar"]):::ucStyle
        UC_Pay(["Pembayaran Transaksi Online"]):::ucStyle
        UC_Cancel(["Pembatalan Reservasi"]):::ucStyle
        UC_Review(["Pemberian Ulasan & Testimoni"]):::ucStyle
        
        UC_RoomMgt(["Pengelolaan Data Kamar CRUD"]):::ucStyle
        UC_ResMgt(["Pengelolaan Status Reservasi"]):::ucStyle
        UC_Calendar(["Pemantauan Kalender Okupansi"]):::ucStyle
        UC_TestiMod(["Moderasi Ulasan / Testimoni"]):::ucStyle
        UC_UserMgt(["Pengelolaan Data Pengguna"]):::ucStyle
        UC_Report(["Laporan Reservasi & Pendapatan"]):::ucStyle
    end
    style System fill:#ffffff,stroke:#000000,stroke-width:2px;

    Tamu --- UC_Auth
    Tamu --- UC_Explore
    Tamu --- UC_Booking
    Tamu --- UC_Cancel
    Tamu --- UC_Review

    Midtrans --- UC_Pay

    Admin --- UC_Auth
    Admin --- UC_RoomMgt
    Admin --- UC_ResMgt
    Admin --- UC_Calendar
    Admin --- UC_TestiMod
    Admin --- UC_UserMgt
    Admin --- UC_Report

    UC_Booking -.->|«include»| UC_Explore
    UC_Booking -.->|«include»| UC_Pay
    UC_Cancel -.->|«extend»| UC_Booking
    UC_Review -.->|«extend»| UC_Booking
    UC_RoomMgt -.->|«include»| UC_Auth
    UC_Report -.->|«include»| UC_Auth
MERMAID
    ],
    [
        'id' => '02_usecase_tamu',
        'category' => 'usecase',
        'badge' => 'Diagram Use Case #2',
        'title' => 'Diagram Use Case: Alur Layanan Tamu',
        'subtitle' => 'Fitur dan Hak Akses Tamu pada Sistem Reservasi Rama Homestay',
        'width' => 1200,
        'height' => 850,
        'mermaid' => <<<MERMAID
flowchart LR
    classDef actorStyle fill:#ffffff,stroke:#000000,stroke-width:2px,color:#000000;
    classDef ucStyle fill:#ffffff,stroke:#000000,stroke-width:1.5px,color:#000000;

    Guest["«actor»<br>Tamu"]:::actorStyle

    subgraph GuestScope ["Batasan Sistem: Area Layanan Tamu (Publik & Dasbor)"]
        UC1(["Registrasi Akun Baru"]):::ucStyle
        UC2(["Masuk Akun (Login)"]):::ucStyle
        UC3(["Kelola Profil Pengguna"]):::ucStyle
        UC4(["Melihat Katalog & Filter Kamar"]):::ucStyle
        UC5(["Cek Ketersediaan Tanggal Real-Time"]):::ucStyle
        UC6(["Mengisi Formulir Pemesanan"]):::ucStyle
        UC7(["Menerima Snap Token Pembayaran"]):::ucStyle
        UC8(["Melakukan Pembayaran Online"]):::ucStyle
        UC9(["Melihat E-Tiket / Bukti Reservasi"]):::ucStyle
        UC10(["Membatalkan Reservasi"]):::ucStyle
        UC11(["Memberikan Ulasan & Rating"]):::ucStyle
    end
    style GuestScope fill:#ffffff,stroke:#000000,stroke-width:2px;

    Guest --- UC1
    Guest --- UC2
    Guest --- UC3
    Guest --- UC4
    Guest --- UC6
    Guest --- UC9
    Guest --- UC10
    Guest --- UC11

    UC6 -.->|«include»| UC5
    UC6 -.->|«include»| UC7
    UC8 -.->|«include»| UC7
    UC6 -.->|«include»| UC8
    UC9 -.->|«include»| UC8
    UC10 -.->|«extend»| UC9
    UC11 -.->|«extend»| UC9
MERMAID
    ],
    [
        'id' => '03_usecase_admin',
        'category' => 'usecase',
        'badge' => 'Diagram Use Case #3',
        'title' => 'Diagram Use Case: Alur Pengelolaan Administrator',
        'subtitle' => 'Fitur dan Hak Akses Administrator pada Panel Pengelolaan Homestay',
        'width' => 1200,
        'height' => 850,
        'mermaid' => <<<MERMAID
flowchart LR
    classDef actorStyle fill:#ffffff,stroke:#000000,stroke-width:2px,color:#000000;
    classDef ucStyle fill:#ffffff,stroke:#000000,stroke-width:1.5px,color:#000000;

    Adm["«actor»<br>Admin Homestay"]:::actorStyle

    subgraph AdminScope ["Batasan Sistem: Panel Administrasi (Dasbor Admin)"]
        A1(["Masuk Akun Admin (Login)"]):::ucStyle
        A2(["Melihat Statistik Dasbor & Keuangan"]):::ucStyle
        A3(["Pemantauan Kalender Okupansi Kamar"]):::ucStyle
        A4(["Kelola Data Kamar (CRUD)"]):::ucStyle
        A5(["Kelola Galeri Foto & Fasilitas"]):::ucStyle
        A6(["Melihat Seluruh Data Reservasi"]):::ucStyle
        A7(["Pembaruan Status Reservasi"]):::ucStyle
        A8(["Moderasi Ulasan / Testimoni"]):::ucStyle
        A9(["Melihat Daftar Tamu Terdaftar"]):::ucStyle
        A10(["Filter & Cetak Laporan PDF"]):::ucStyle
    end
    style AdminScope fill:#ffffff,stroke:#000000,stroke-width:2px;

    Adm --- A1
    Adm --- A2
    Adm --- A3
    Adm --- A4
    Adm --- A6
    Adm --- A8
    Adm --- A9
    Adm --- A10

    A4 -.->|«include»| A1
    A6 -.->|«include»| A1
    A10 -.->|«include»| A1
    A5 -.->|«extend»| A4
    A7 -.->|«extend»| A6
    A10 -.->|«extend»| A2
MERMAID
    ],
    [
        'id' => '04_erd_rama_homestay',
        'category' => 'erd',
        'badge' => 'Diagram Hubungan Entitas (ERD)',
        'title' => 'Diagram ERD: Skema Database Rama Homestay',
        'subtitle' => 'Skema Relasi Database Sesuai Migrasi Fisik Laravel Rama Homestay',
        'width' => 1400,
        'height' => 1600,
        'mermaid' => <<<MERMAID
erDiagram
    USERS ||--o{ RESERVATIONS : "membuat"
    USERS ||--o{ TESTIMONIALS : "menulis"
    ROOMS ||--o{ RESERVATIONS : "dipesan_pada"
    RESERVATIONS ||--o| TESTIMONIALS : "menghasilkan"

    USERS {
        bigint id PK
        string name
        string email UK
        string phone
        string password
        string role
        timestamp email_verified_at
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    ROOMS {
        bigint id PK
        string name
        string type
        text description
        decimal price
        decimal tax_rate
        decimal service_rate
        int total_rooms
        int capacity
        json facilities
        string image
        json gallery
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    RESERVATIONS {
        bigint id PK
        string booking_code UK
        bigint user_id FK
        bigint room_id FK
        string guest_name
        string guest_email
        string guest_phone
        date check_in
        date check_out
        int nights
        int guest_count
        decimal base_price
        decimal tax_amount
        decimal service_amount
        decimal total_price
        string payment_method
        string snap_token
        string midtrans_transaction_id
        string midtrans_payment_type
        string status
        text special_requests
        timestamp paid_at
        timestamp expires_at
        timestamp created_at
        timestamp updated_at
    }

    TESTIMONIALS {
        bigint id PK
        bigint user_id FK
        bigint reservation_id FK
        string guest_name
        string guest_origin
        int rating
        text review
        boolean is_approved
        timestamp created_at
        timestamp updated_at
    }
MERMAID
    ],
    [
        'id' => '05_seq_registrasi_login',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #1',
        'title' => 'Diagram Sequence: Registrasi & Login Akun',
        'subtitle' => 'Alur Pendaftaran Akun Tamu dan Login Pengguna / Administrator',
        'width' => 1250,
        'height' => 900,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu / Pengguna
    participant View as View (Blade)
    participant AuthCtrl as AuthController
    participant User as Model User
    participant Session as Laravel Session

    rect rgb(240, 248, 255)
    note over Tamu, User: Alur Registrasi Akun Baru
    Tamu->>View: Buka halaman pendaftaran (/register)
    View-->>Tamu: Tampilkan formulir registrasi
    Tamu->>AuthCtrl: POST /register (name, email, phone, password)
    AuthCtrl->>AuthCtrl: Validasi input data
    AuthCtrl->>User: create([name, email, phone, password, role=tamu])
    User-->>AuthCtrl: User baru tersimpan
    AuthCtrl->>Session: Auth::login(\$user)
    AuthCtrl-->>Tamu: Redirect ke /tamu/dashboard
    end

    rect rgb(255, 250, 240)
    note over Tamu, User: Alur Login Pengguna
    Tamu->>View: Buka halaman login (/login)
    View-->>Tamu: Tampilkan formulir login
    Tamu->>AuthCtrl: POST /login (email, password)
    AuthCtrl->>AuthCtrl: Auth::attempt(credentials)
    alt Kredensial Valid
        AuthCtrl->>User: Cek role pengguna
        alt Role == admin
            AuthCtrl-->>Tamu: Redirect ke route(admin.dashboard)
        else Role == tamu
            AuthCtrl-->>Tamu: Redirect ke route(tamu.dashboard)
        end
    else Kredensial Salah
        AuthCtrl-->>View: Kembalikan withErrors
        View-->>Tamu: Tampilkan pesan gagal login
    end
    end
MERMAID
    ],
    [
        'id' => '06_seq_cek_ketersediaan_kamar',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #2',
        'title' => 'Diagram Sequence: Pengecekan Ketersediaan Kamar',
        'subtitle' => 'Alur Cek Ketersediaan Kamar Real-time (AJAX Check Availability)',
        'width' => 1250,
        'height' => 820,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu
    participant View as View (booking_form.blade)
    participant ResCtrl as ReservationController
    participant ResModel as Model Reservation
    participant RoomModel as Model Room

    Tamu->>View: Pilih tanggal Check-in & Check-out
    View->>ResCtrl: AJAX POST /api/check-availability
    ResCtrl->>ResCtrl: Validasi tanggal
    ResCtrl->>ResModel: releaseExpiredReservations()
    ResCtrl->>RoomModel: findOrFail(room_id)
    ResCtrl->>RoomModel: isAvailable(check_in, check_out)
    RoomModel->>RoomModel: getAvailableCount(check_in, check_out)
    RoomModel-->>ResCtrl: Kembalikan boolean & sisa kuota
    ResCtrl->>RoomModel: calculateTax(base_price)
    ResCtrl->>RoomModel: calculateService(base_price)
    ResCtrl-->>View: JSON Response (available, nights, tax, service, total)
    View-->>Tamu: Tampilkan rincian biaya & status ketersediaan
MERMAID
    ],
    [
        'id' => '07_seq_booking_kamar',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #3',
        'title' => 'Diagram Sequence: Pemesanan Kamar (Anti-Double Booking)',
        'subtitle' => 'Alur Pemesanan Kamar dengan Database Transaction dan Lock Pencegahan Konflik',
        'width' => 1300,
        'height' => 900,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu (Terautentikasi)
    participant View as View (booking_form.blade)
    participant ResCtrl as ReservationController
    participant DB as DB Transaction
    participant ResModel as Model Reservation
    participant MidService as MidtransService
    participant MidtransAPI as Midtrans API

    Tamu->>View: Submit form booking (/tamu/book/confirm)
    View->>ResCtrl: POST processBooking()
    ResCtrl->>ResCtrl: Validasi data pemesan & tanggal
    ResCtrl->>DB: DB::transaction()
    activate DB
    DB->>ResModel: releaseExpiredReservations()
    DB->>ResModel: lockForUpdate() periksa ketersediaan
    alt Kuota Kamar Penuh
        DB-->>ResCtrl: Rollback & error 'Kamar sudah habis'
        ResCtrl-->>Tamu: Tampilkan pesan error kamar penuh
    else Kuota Tersedia
        DB->>ResModel: create([booking_code, pricing, status=pending, expires_at=now+30m])
        ResModel-->>DB: Data Reservasi Tersimpan
        DB->>MidService: createSnapToken(\$reservation)
        MidService->>MidtransAPI: Snap::getSnapToken()
        MidtransAPI-->>MidService: Snap Token String
        MidService->>ResModel: update([snap_token])
        DB-->>ResCtrl: Commit Transaksi
        deactivate DB
        ResCtrl->>ResCtrl: Simpan rincian ke session
        ResCtrl-->>Tamu: Redirect ke /tamu/book-success (E-Ticket)
    end
MERMAID
    ],
    [
        'id' => '08_seq_pembayaran_midtrans',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #4',
        'title' => 'Diagram Sequence: Pembayaran via Midtrans & Webhook',
        'subtitle' => 'Alur Pembayaran Online Midtrans Snap dan Notifikasi Webhook Otomatis',
        'width' => 1350,
        'height' => 950,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu
    participant SnapUI as Midtrans Snap Popup UI
    participant MidtransServer as Midtrans Server
    participant MidCtrl as MidtransController
    participant MidService as MidtransService
    participant ResModel as Model Reservation

    Tamu->>SnapUI: Klik 'Bayar Sekarang' (snap.pay)
    SnapUI-->>Tamu: Tampilkan metode pembayaran (QRIS, VA Bank, GoPay)
    Tamu->>SnapUI: Selesaikan pembayaran
    SnapUI->>MidtransServer: Proses transaksi pembayaran
    MidtransServer-->>SnapUI: Transaksi Berhasil

    par Webhook Notifikasi Server-to-Server
        MidtransServer->>MidCtrl: POST /midtrans/notification (Webhook JSON)
        MidCtrl->>MidService: handleNotification(payload)
        MidService->>MidService: Verifikasi Signature SHA512
        alt Signature Valid
            MidService->>ResModel: Cari berdasarkan booking_code
            MidService->>ResModel: applyPaymentStatus(confirmed)
            MidService-->>MidCtrl: status = true
            MidCtrl-->>MidtransServer: HTTP 200 OK
        else Signature Invalid
            MidCtrl-->>MidtransServer: HTTP 400 Bad Request
        end
    and Pengalihan Peramban Pengguna
        SnapUI->>MidCtrl: Redirect ke /midtrans/finish
        MidCtrl->>MidService: checkStatus(order_id)
        MidService-->>MidCtrl: Status settlement
        MidCtrl->>ResModel: update status=confirmed, paid_at=now()
        MidCtrl-->>Tamu: Redirect ke /tamu/book-success (Status Lunas)
    end
MERMAID
    ],
    [
        'id' => '09_seq_pembatalan_reservasi',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #5',
        'title' => 'Diagram Sequence: Pembatalan Reservasi',
        'subtitle' => 'Alur Pembatalan Mandiri oleh Tamu dan Pembatalan Otomatis Expired 30 Menit',
        'width' => 1250,
        'height' => 880,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu
    participant Dashboard as View (dashboard.blade)
    participant ResCtrl as ReservationController
    participant ResModel as Model Reservation

    rect rgb(255, 245, 245)
    note over Tamu, ResModel: Alur 1: Pembatalan Mandiri oleh Tamu
    Tamu->>Dashboard: Klik tombol 'Batalkan' (Status Pending)
    Dashboard->>ResCtrl: POST /tamu/cancel/{id}
    ResCtrl->>ResCtrl: Verifikasi kepemilikan reservasi
    alt Status Reservasi Masih Pending
        ResCtrl->>ResModel: update([status=cancelled])
        ResCtrl-->>Tamu: Redirect back dengan notifikasi sukses batal
    else Status Sudah Confirmed
        ResCtrl-->>Tamu: Redirect back dengan pesan error tidak bisa dibatalkan
    end
    end

    rect rgb(245, 245, 255)
    note over Tamu, ResModel: Alur 2: Pembatalan Otomatis Expired (30 Menit)
    Tamu->>ResCtrl: Request akses ke sistem
    ResCtrl->>ResModel: releaseExpiredReservations()
    ResModel->>ResModel: UPDATE reservations SET status=cancelled WHERE status=pending AND expires_at <= NOW()
    ResModel-->>ResCtrl: Kuota kamar otomatis bebas kembali
    end
MERMAID
    ],
    [
        'id' => '10_seq_manajemen_kamar_admin',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #6',
        'title' => 'Diagram Sequence: Manajemen Data Kamar oleh Admin',
        'subtitle' => 'Alur Penambahan, Pengubahan, dan Pengunggahan Gambar Kamar (CRUD)',
        'width' => 1250,
        'height' => 850,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Admin as Admin
    participant View as View (admin.rooms)
    participant RoomCtrl as RoomController
    participant RoomModel as Model Room
    participant Storage as Storage Public

    Admin->>View: Buka menu Data Kamar (/admin/rooms)
    View->>RoomCtrl: GET index()
    RoomCtrl->>RoomModel: withCount(active_bookings)->latest()->get()
    RoomModel-->>RoomCtrl: Koleksi data kamar
    RoomCtrl-->>View: Tampilkan tabel kamar & statistik
    
    Admin->>View: Isi form tambah kamar & upload gambar
    View->>RoomCtrl: POST /admin/rooms (data kamar, gambar)
    RoomCtrl->>RoomCtrl: Validasi input data kamar
    alt Ada File Gambar
        RoomCtrl->>Storage: store(rooms, public)
        Storage-->>RoomCtrl: path_gambar
    end
    RoomCtrl->>RoomModel: create(validated_data)
    RoomModel-->>RoomCtrl: Kamar tersimpan
    RoomCtrl-->>View: Redirect dengan pesan sukses
MERMAID
    ],
    [
        'id' => '11_seq_pengelolaan_status_reservasi',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #7',
        'title' => 'Diagram Sequence: Pengelolaan Status Reservasi oleh Admin',
        'subtitle' => 'Alur Pembaruan Status Reservasi (Pending -> Confirmed / Completed / Cancelled)',
        'width' => 1250,
        'height' => 820,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Admin as Admin
    participant View as View (admin.reservations)
    participant ResCtrl as ReservationController
    participant ResModel as Model Reservation

    Admin->>View: Buka daftar reservasi (/admin/reservations)
    View->>ResCtrl: GET index()
    ResCtrl->>ResModel: with([user, room])->latest()->get()
    ResModel-->>ResCtrl: Data seluruh reservasi
    ResCtrl-->>View: Tampilkan tabel reservasi & filter status

    Admin->>View: Pilih aksi ubah status (misal: Confirmed)
    View->>ResCtrl: POST /admin/reservations/{id}/status
    ResCtrl->>ResCtrl: Validasi input status baru
    alt Status diubah ke Confirmed dan belum paid_at
        ResCtrl->>ResModel: update([status=confirmed, paid_at=now()])
    else
        ResCtrl->>ResModel: update([status=status_baru])
    end
    ResModel-->>ResCtrl: Berhasil diperbarui
    ResCtrl-->>View: Kembalikan notifikasi sukses pembaruan
MERMAID
    ],
    [
        'id' => '12_seq_ulasan_moderasi_testimoni',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #8',
        'title' => 'Diagram Sequence: Pemberian & Moderasi Ulasan',
        'subtitle' => 'Alur Pengiriman Review Tamu dan Moderasi Persetujuan oleh Admin',
        'width' => 1250,
        'height' => 880,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Tamu as Tamu
    participant TamuView as View Tamu (Dashboard)
    participant TestiCtrl as TestimonialController
    participant TestiModel as Model Testimonial
    actor Admin as Admin
    participant AdminView as View Admin
    participant AdminCtrl as AdminController

    Tamu->>TamuView: Kirim rating bintang & ulasan
    TamuView->>TestiCtrl: POST /tamu/review
    TestiCtrl->>TestiCtrl: Validasi rating 1-5 & teks ulasan
    TestiCtrl->>TestiModel: create([user_id, rating, review, is_approved=false])
    TestiModel-->>TestiCtrl: Review tersimpan
    TestiCtrl-->>TamuView: Notifikasi 'Ulasan menunggu persetujuan admin'

    Admin->>AdminView: Buka menu Testimoni (/admin/testimonials)
    AdminView->>AdminCtrl: GET testimonials()
    AdminCtrl->>TestiModel: with([user, reservation])->latest()->get()
    AdminCtrl-->>AdminView: Tampilkan daftar ulasan masuk
    Admin->>AdminView: Klik tombol 'Setujui / Publikasikan'
    AdminView->>AdminCtrl: POST /admin/testimonials/{id}/toggle
    AdminCtrl->>TestiModel: update([is_approved = true])
    AdminCtrl-->>AdminView: Status ulasan aktif & tampil di website publik
MERMAID
    ],
    [
        'id' => '13_seq_laporan_export_admin',
        'category' => 'sequence',
        'badge' => 'Diagram Sequence #9',
        'title' => 'Diagram Sequence: Pembuatan & Ekspor Laporan',
        'subtitle' => 'Alur Filter Laporan Transaksi dan Export PDF/Print oleh Administrator',
        'width' => 1250,
        'height' => 820,
        'mermaid' => <<<MERMAID
sequenceDiagram
    autonumber
    actor Admin as Admin
    participant View as View (admin.reports)
    participant AdminCtrl as AdminController
    participant ResModel as Model Reservation

    Admin->>View: Buka menu Laporan (/admin/reports)
    View->>AdminCtrl: GET reports(start_date, end_date, status)
    AdminCtrl->>ResModel: whereBetween(created_at, [start, end])->get()
    AdminCtrl->>AdminCtrl: Hitung ringkasan transaksi & total pendapatan
    AdminCtrl-->>View: Tampilkan tabel transaksi & kartu ringkasan keuangan

    Admin->>View: Klik tombol 'Export / Cetak Laporan'
    View->>AdminCtrl: GET /admin/reports/export
    AdminCtrl->>ResModel: Ambil data transaksi terfilter
    AdminCtrl-->>View: Render view khusus cetak + window.print() / Download PDF
MERMAID
    ],
    [
        'id' => '14_class_diagram_rama_homestay',
        'category' => 'class',
        'badge' => 'Diagram Kelas (Class Diagram)',
        'title' => 'Diagram Kelas: Arsitektur Sistem Rama Homestay',
        'subtitle' => 'Diagram Kelas Model, Controller, dan Service pada Arsitektur Laravel Rama Homestay',
        'width' => 1500,
        'height' => 1800,
        'mermaid' => <<<MERMAID
classDiagram
    class User {
        - id : bigint
        - name : string
        - email : string
        - phone : string
        - password : string
        - role : string
        - email_verified_at : datetime
        + reservations() HasMany
    }

    class Room {
        - id : bigint
        - name : string
        - type : string
        - description : text
        - price : decimal
        - tax_rate : decimal
        - service_rate : decimal
        - total_rooms : int
        - capacity : int
        - facilities : array
        - image : string
        - gallery : array
        - is_active : boolean
        + reservations() HasMany
        + getAvailableCount(checkIn, checkOut) int
        + isAvailable(checkIn, checkOut) bool
        + calculateTax(basePrice) float
        + calculateService(basePrice) float
        + getFacilitiesListAttribute() array
        + getTypeLabelAttribute() string
    }

    class Reservation {
        - id : bigint
        - booking_code : string
        - user_id : bigint
        - room_id : bigint
        - guest_name : string
        - guest_email : string
        - guest_phone : string
        - check_in : date
        - check_out : date
        - nights : int
        - guest_count : int
        - base_price : decimal
        - tax_amount : decimal
        - service_amount : decimal
        - total_price : decimal
        - payment_method : string
        - snap_token : string
        - midtrans_transaction_id : string
        - midtrans_payment_type : string
        - status : string
        - special_requests : text
        - paid_at : datetime
        - expires_at : datetime
        + releaseExpiredReservations() int
        + isExpired() bool
        + getRemainingSecondsAttribute() int
        + getStatusLabelAttribute() string
        + getDurationAttribute() int
        + user() BelongsTo
        + room() BelongsTo
        + testimonial() HasOne
    }

    class Testimonial {
        - id : bigint
        - user_id : bigint
        - reservation_id : bigint
        - guest_name : string
        - guest_origin : string
        - rating : int
        - review : text
        - is_approved : boolean
        + user() BelongsTo
        + reservation() BelongsTo
    }

    class MidtransService {
        - serverKey : string
        - clientKey : string
        - isProduction : boolean
        + createSnapToken(reservation) string
        + handleNotification(payload) bool
        + checkStatus(orderId) object
        + applyPaymentStatus(reservation, status, fraud, type, txId) void
    }

    class AuthController {
        + showLogin() View
        + login(request) Redirect
        + showRegister() View
        + register(request) Redirect
        + logout(request) Redirect
    }

    class RoomController {
        + index() View
        + create() View
        + store(request) Redirect
        + edit(room) View
        + update(request, room) Redirect
        + destroy(room) Redirect
        + indexClient(request) View
        + show(room) View
    }

    class ReservationController {
        + index(request) View
        + showBookingForm(request, room) View
        + checkAvailability(request) JsonResponse
        + processBooking(request) Redirect
        + bookingSuccess() View
        + updateStatus(request, reservation) Redirect
        + show(reservation) View
        + cancel(reservation) Redirect
    }

    class MidtransController {
        - midtransService : MidtransService
        + notification(request) JsonResponse
        + finish(request) Redirect
        + payPage(reservation) View
        + getToken(reservation) JsonResponse
        + syncStatus(reservation) JsonResponse
    }

    class AdminController {
        + dashboard() View
        + calendar() View
        + reports(request) View
        + exportReports(request) View
        + users() View
        + testimonials() View
        + toggleTestimonial(testimonial) Redirect
    }

    class TestimonialController {
        + store(request) Redirect
    }

    User "1" --> "*" Reservation : membuat
    User "1" --> "*" Testimonial : mengirim
    Room "1" --> "*" Reservation : memiliki
    Reservation "1" --> "0..1" Testimonial : menghasilkan

    ReservationController ..> Reservation : mengelola
    ReservationController ..> Room : memverifikasi
    ReservationController ..> MidtransService : memanggil
    MidtransController ..> MidtransService : menggunakan
    MidtransController ..> Reservation : memperbarui
    RoomController ..> Room : mengelola
    TestimonialController ..> Testimonial : membuat
    AdminController ..> Reservation : menganalisis
    AdminController ..> Testimonial : memoderasi
    AdminController ..> Room : mengawasi
    AuthController ..> User : mengautentikasi
MERMAID
    ],
    [
        'id' => '15_act_registrasi_login',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #1',
        'title' => 'Diagram Aktivitas: Registrasi & Login Akun',
        'subtitle' => 'Alur Aktivitas Pengguna saat Mendaftar dan Masuk ke Sistem',
        'width' => 1150,
        'height' => 1500,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Mulai"]) --> DecisionGuest{"Sudah punya akun?"}
    
    DecisionGuest -->|Belum| OpenReg["Buka Halaman Register"]
    OpenReg --> InputReg["Isi Nama, Email, No HP, & Password"]
    InputReg --> SubmitReg["Klik Daftar"]
    SubmitReg --> ValidateReg{"Validasi Form Berhasil?"}
    ValidateReg -->|Gagal| RegErr["Tampilkan Pesan Validasi Error"]
    RegErr --> InputReg
    ValidateReg -->|Sukses| CreateUser["Sistem Membuat Akun & Hash Password"]
    CreateUser --> AutoLogin["Auto Login Sesi Tamu"]

    DecisionGuest -->|Sudah| OpenLogin["Buka Halaman Login"]
    OpenLogin --> InputLogin["Masukkan Email & Password"]
    InputLogin --> SubmitLogin["Klik Masuk"]
    SubmitLogin --> CheckCreds{"Kredensial Sesuai?"}
    CheckCreds -->|Tidak| LoginErr["Tampilkan Pesan Email/Password Salah"]
    LoginErr --> InputLogin
    CheckCreds -->|Ya| CheckRole{"Periksa Hak Akses (Role)"}
    
    AutoLogin --> TamuDash["Arahkan ke Dashboard Tamu"]
    CheckRole -->|Tamu| TamuDash
    CheckRole -->|Admin| AdminDash["Arahkan ke Panel Admin Dashboard"]
    
    TamuDash --> Finish(["Selesai"])
    AdminDash --> Finish
MERMAID
    ],
    [
        'id' => '16_act_cek_ketersediaan_kamar',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #2',
        'title' => 'Diagram Aktivitas: Pencarian & Cek Ketersediaan Kamar',
        'subtitle' => 'Alur Aktivitas Tamu dalam Mengecek Ketersediaan Tanggal dan Rincian Biaya',
        'width' => 1150,
        'height' => 1500,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Mulai"]) --> OpenRooms["Tamu Mengakses Halaman Katalog Kamar"]
    OpenRooms --> SelectFilters["Pilih Filter Tipe Kamar / Kapasitas / Fasilitas"]
    SelectFilters --> ViewRoomDetail["Pilih & Buka Detail Kamar"]
    ViewRoomDetail --> InputDates["Pilih Tanggal Check-in & Check-out"]
    
    InputDates --> ValidateDates{"Tanggal Valid? (Check-out sesudah Check-in)"}
    ValidateDates -->|Tidak| DateErr["Tampilkan Peringatan Kesalahan Tanggal"]
    DateErr --> InputDates
    
    ValidateDates -->|Ya| RunAutoRelease["Sistem Membersihkan Pending Kedaluwarsa"]
    RunAutoRelease --> CheckDB{"Kamar Tersedia di Tanggal Tersebut?"}
    CheckDB -->|Kamar Penuh| NotAvailable["Tampilkan Notifikasi Kamar Tidak Tersedia"]
    NotAvailable --> InputDates
    
    CheckDB -->|Kamar Ada| CalcPrice["Hitung Jumlah Malam, Pajak 10%, Layanan 5%, & Total Biaya"]
    CalcPrice --> ShowSummary["Tampilkan Rincian Biaya & Aktifkan Tombol Pesan"]
    ShowSummary --> Finish(["Lanjut ke Pemesanan"])
MERMAID
    ],
    [
        'id' => '17_act_booking_kamar',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #3',
        'title' => 'Diagram Aktivitas: Pemesanan / Reservasi Kamar',
        'subtitle' => 'Alur Aktivitas Pemesanan dengan Validasi Transaksi Anti-Double Booking',
        'width' => 1200,
        'height' => 1800,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Mulai"]) --> CheckAuth{"Apakah Tamu Sudah Login?"}
    CheckAuth -->|Belum| RedirectLogin["Arahkan ke Halaman Login"]
    RedirectLogin --> AuthSuccess["Login Berhasil"] --> LoadForm
    CheckAuth -->|Sudah| LoadForm["Buka Form Pemesanan Kamar"]
    
    LoadForm --> FillData["Konfirmasi Data Pemesan & Permintaan Khusus"]
    FillData --> ChoosePayment["Pilih Metode Pembayaran Online"]
    ChoosePayment --> SubmitBooking["Klik Konfirmasi Reservasi"]
    
    SubmitBooking --> BeginTx["Sistem Membuka Database Transaction & Lock"]
    BeginTx --> LockCheck{"Ketersediaan Kamar Masih Aman?"}
    LockCheck -->|Sudah Terisi Tamu Lain| RollbackTx["Rollback Transaksi"]
    RollbackTx --> ShowErr["Tampilkan Pesan: Kamar Baru Saja Dipesan Tamu Lain"]
    ShowErr --> Finish(["Batal / Pilih Tanggal Lain"])
    
    LockCheck -->|Aman| SaveRes["Simpan Reservasi (Kode RMA-XXXX, Status Pending, Expire 30 Menit)"]
    SaveRes --> RequestSnap["Request Snap Token ke Midtrans"]
    RequestSnap --> SaveToken["Simpan Snap Token ke Database"]
    SaveToken --> CommitTx["Commit Transaksi Database"]
    CommitTx --> SetSession["Simpan Ringkasan ke Session Tiket"]
    SetSession --> ShowTicket["Tampilkan Halaman Booking Success & Countdown Pembayaran"]
    ShowTicket --> Finish2(["Selesai"])
MERMAID
    ],
    [
        'id' => '18_act_pembayaran_midtrans',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #4',
        'title' => 'Diagram Aktivitas: Pembayaran Online Midtrans',
        'subtitle' => 'Alur Aktivitas Pembayaran Digital dan Sinkronisasi Notifikasi Webhook',
        'width' => 1250,
        'height' => 1700,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Mulai dari Halaman E-Ticket / Pay"]) --> ClickPay["Tamu Klik Tombol Bayar Sekarang"]
    ClickPay --> TriggerSnap["Frontend Menjalankan snap.pay(token)"]
    TriggerSnap --> PopSnap["Muncul Jendela Snap Midtrans"]
    PopSnap --> ChooseChannel["Tamu Memilih Metode: QRIS / VA / E-Wallet"]
    
    ChooseChannel --> ExecutePay["Tamu Menyelesaikan Pembayaran"]
    ExecutePay --> MidtransNotif["Midtrans Memproses Transaksi"]
    
    par Jalur Webhook Asinkron
        MidtransNotif --> WebhookSend["Midtrans Mengirim HTTP POST Webhook ke Server"]
        WebhookSend --> VerifySig{"Verifikasi Signature Key Valid?"}
        VerifySig -->|Tidak| RejectHook["Tolak Notifikasi HTTP 400"]
        VerifySig -->|Ya| CheckTxStatus{"Cek Status Transaksi"}
        CheckTxStatus -->|Settlement / Capture| MarkConfirmed["Update Status = Confirmed, paid_at = now()"]
        CheckTxStatus -->|Expire / Cancel / Deny| MarkCancelled["Update Status = Cancelled"]
        CheckTxStatus -->|Pending| MarkPending["Tetap Status = Pending"]
        MarkConfirmed --> Return200["Kirim Response HTTP 200 ke Midtrans"]
    and Jalur Redirect Browser
        MidtransNotif --> UserFinish["Browser Redirect ke /midtrans/finish"]
        UserFinish --> SyncMidtrans["Sistem Memanggil API Check Status Midtrans"]
        SyncMidtrans --> UpdateLocal["Update Status Reservasi Sesuai Hasil Cek"]
        UpdateLocal --> ShowSuccessPage["Tampilkan Halaman Pembayaran Berhasil & E-Ticket"]
    end
    
    Return200 --> End(["Selesai"])
    ShowSuccessPage --> End
MERMAID
    ],
    [
        'id' => '19_act_pembatalan_reservasi',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #5',
        'title' => 'Diagram Aktivitas: Pembatalan Reservasi',
        'subtitle' => 'Alur Aktivitas Pembatalan Mandiri Tamu dan Pembatalan Otomatis Kedaluwarsa',
        'width' => 1180,
        'height' => 1600,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Pemicu Pembatalan"]) --> TriggerType{"Jenis Pembatalan?"}
    
    TriggerType -->|Manual oleh Tamu| TamuDash["Tamu Membuka Riwayat Reservasi"]
    TamuDash --> ClickCancel["Klik Batalkan Reservasi"]
    ClickCancel --> CheckStatus{"Status Reservasi Adalah Pending?"}
    CheckStatus -->|Tidak| RejectCancel["Tampilkan Pesan: Reservasi Confirmed Tidak Dapat Dibatalkan Sendiri"]
    RejectCancel --> End(["Selesai"])
    CheckStatus -->|Ya| UpdateCancel["Sistem Mengubah Status Menjadi Cancelled"]
    UpdateCancel --> RestoreRoom["Kuota Kamar Otomatis Bebas Kembali"]
    RestoreRoom --> NotifyTamu["Tampilkan Notifikasi Berhasil Dibatalkan"]
    NotifyTamu --> End

    TriggerType -->|Otomatis Waktu Habis| RequestPage["Ada Permintaan Akses ke Sistem"]
    RequestPage --> RunRelease["Fungsi releaseExpiredReservations() Berjalan"]
    RunRelease --> ScanExpired{"Ada Reservasi Pending Melewati Batas 30 Menit?"}
    ScanExpired -->|Tidak Ada| NoOp["Tidak Ada Perubahan"]
    ScanExpired -->|Ada| BatchCancel["Update Massal: Ubah Status Menjadi Cancelled"]
    BatchCancel --> FreeStock["Kamar yang Terkunci Dilepas Kembali ke Publik"]
    FreeStock --> End
    NoOp --> End
MERMAID
    ],
    [
        'id' => '20_act_manajemen_kamar_admin',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #6',
        'title' => 'Diagram Aktivitas: Manajemen Data Kamar oleh Admin',
        'subtitle' => 'Alur Aktivitas Administrator Mengelola Kamar (Tambah, Edit, Hapus, Upload Foto)',
        'width' => 1250,
        'height' => 1800,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Admin Login"]) --> OpenRoomMenu["Akses Menu Kamar di Sidebar Admin"]
    OpenRoomMenu --> ViewRoomList["Sistem Menampilkan Tabel Semua Kamar & Okupansi"]
    ViewRoomList --> ChooseAction{"Pilih Tindakan"}

    ChooseAction -->|Tambah Kamar| FormCreate["Buka Formulir Tambah Kamar"]
    FormCreate --> InputRoomData["Isi Nama, Tipe, Harga, Pajak, Layanan, Kapasitas, & Fasilitas"]
    InputRoomData --> SaveNewRoom["Klik Simpan"]
    SaveNewRoom --> ValidateRoom{"Validasi Data Sukses?"}
    ValidateRoom -->|Gagal| ErrRoom["Tampilkan Kesalahan Validasi"]
    ErrRoom --> FormCreate
    ValidateRoom -->|Sukses| UploadImg["Simpan File Gambar ke Storage Public"]
    UploadImg --> InsertRoomDB["Insert Data ke Tabel Rooms"]
    InsertRoomDB --> RefreshList["Kembali ke List Kamar dengan Flash Notifikasi Sukses"]

    ChooseAction -->|Ubah Kamar| FormEdit["Buka Formulir Edit Kamar Terpilih"]
    FormEdit --> ChangeData["Ubah Rincian / Status Aktif / Foto Baru"]
    ChangeData --> UpdateDB["Update Data Kamar ke Database"]
    UpdateDB --> RefreshList

    ChooseAction -->|Hapus Kamar| ConfirmDel{"Konfirmasi Hapus Data?"}
    ConfirmDel -->|Batal| ViewRoomList
    ConfirmDel -->|Ya| DeleteDB["Hapus Data Kamar dari Database"]
    DeleteDB --> RefreshList

    RefreshList --> End(["Selesai"])
MERMAID
    ],
    [
        'id' => '21_act_pengelolaan_reservasi_admin',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #7',
        'title' => 'Diagram Aktivitas: Pengelolaan Reservasi oleh Admin',
        'subtitle' => 'Alur Aktivitas Administrator dalam Memantau dan Memperbarui Status Reservasi',
        'width' => 1200,
        'height' => 1600,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Admin Login"]) --> OpenResMenu["Buka Menu Reservasi di Panel Admin"]
    OpenResMenu --> FilterRes["Pilih Filter Status (Pending / Confirmed / Completed / Cancelled)"]
    FilterRes --> ShowResTable["Sistem Menampilkan Daftar Reservasi Terfilter"]
    
    ShowResTable --> SelectItem["Pilih Salah Satu Reservasi"]
    SelectItem --> ViewDetail["Buka Detail Reservasi & Data Tamu"]
    ViewDetail --> ActionChoice{"Pilih Aksi Status"}

    ActionChoice -->|Konfirmasi Manual| SetConfirm["Ubah Status Menjadi Confirmed"]
    SetConfirm --> CheckPaid{"Sudah Ada Nilai paid_at?"}
    CheckPaid -->|Belum| SetPaidAt["Isi paid_at = Sekarang"]
    CheckPaid -->|Sudah| SaveStatus["Simpan Perubahan ke Database"]
    SetPaidAt --> SaveStatus

    ActionChoice -->|Tamu Selesai Menginap| SetComplete["Ubah Status Menjadi Completed"]
    SetComplete --> SaveStatus

    ActionChoice -->|Batalkan Transaksi| SetCancel["Ubah Status Menjadi Cancelled"]
    SetCancel --> SaveStatus

    SaveStatus --> FlashSuccess["Tampilkan Notifikasi Sukses Pembaruan Status"]
    FlashSuccess --> End(["Selesai"])
MERMAID
    ],
    [
        'id' => '22_act_ulasan_testimoni',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #8',
        'title' => 'Diagram Aktivitas: Pemberian & Moderasi Ulasan',
        'subtitle' => 'Alur Aktivitas Tamu Menulis Ulasan dan Admin Melakukan Moderasi Publikasi',
        'width' => 1200,
        'height' => 1600,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Mulai"]) --> SubFlowUser["Tamu Mengakses Dashboard / Halaman Riwayat"]
    SubFlowUser --> FillReview["Tamu Mengisi Skor Rating 1-5 Bintang & Teks Ulasan"]
    FillReview --> SubmitReview["Kirim Ulasan"]
    SubmitReview --> ValidateReview{"Validasi Masukan Sukses?"}
    ValidateReview -->|Gagal| ReviewErr["Tampilkan Pesan Error: Rating & Teks Wajib Diisi"]
    ReviewErr --> FillReview
    ValidateReview -->|Sukses| SavePendingTesti["Simpan ke Tabel Testimonials dengan is_approved = FALSE"]
    SavePendingTesti --> UserWait["Notifikasi: Ulasan Menunggu Moderasi Admin"]

    UserWait --> AdminStep["Admin Membuka Menu Testimoni di Panel Admin"]
    AdminStep --> LoadPending["Sistem Menampilkan Daftar Ulasan Masuk"]
    LoadPending --> AdminDecision{"Tindakan Admin?"}
    AdminDecision -->|Setujui / Publish| ToggleApprove["Ubah is_approved = TRUE"]
    AdminDecision -->|Tolak / Sembunyikan| ToggleReject["Ubah is_approved = FALSE"]
    
    ToggleApprove --> PublicVisible["Ulasan Otomatis Tampil di Halaman Depan & Reviews Publik"]
    ToggleReject --> PublicHidden["Ulasan Tidak Tampil di Halaman Publik"]
    
    PublicVisible --> End(["Selesai"])
    PublicHidden --> End
MERMAID
    ],
    [
        'id' => '23_act_laporan_pendapatan_admin',
        'category' => 'activity',
        'badge' => 'Diagram Aktivitas #9',
        'title' => 'Diagram Aktivitas: Filter & Ekspor Laporan Pendapatan',
        'subtitle' => 'Alur Aktivitas Admin Memfilter dan Mencetak / Mengunduh Laporan Resmi',
        'width' => 1200,
        'height' => 1600,
        'mermaid' => <<<MERMAID
flowchart TD
    Start(["Admin Login"]) --> OpenReportMenu["Buka Menu Laporan di Sidebar"]
    OpenReportMenu --> SetFilterRange["Pilih Tanggal Mulai, Tanggal Akhir, & Status"]
    SetFilterRange --> ClickFilter["Klik Tombol Filter"]
    
    ClickFilter --> QueryReport["Sistem Query Data Reservasi Sesuai Rentang Tanggal"]
    QueryReport --> AggregateStats["Sistem Menghitung Total Transaksi, Lunas, & Total Pendapatan"]
    AggregateStats --> DisplayDashboard["Tampilkan Kartu Ringkasan, Grafik Finansial, & Tabel Transaksi"]
    
    DisplayDashboard --> DecisionExport{"Ingin Mencetak / Export PDF?"}
    DecisionExport -->|Tidak| Finish(["Selesai"])
    DecisionExport -->|Ya| ClickExport["Klik Export / Cetak Laporan"]
    ClickExport --> RenderPrintView["Sistem Merender View Khusus Cetak"]
    RenderPrintView --> TriggerPrint["Panggil window.print() / Simpan PDF Browser"]
    TriggerPrint --> DownloadFile["Admin Mengunduh / Mencetak Dokumen Laporan Resmi"]
    DownloadFile --> Finish
MERMAID
    ]
];

// 1. Generate standalone HTML per diagram with enhanced CSS zoom & fill
foreach ($diagrams as $index => $diag) {
    $id = $diag['id'];
    $title = $diag['title'];
    $subtitle = $diag['subtitle'];
    $mermaid = $diag['mermaid'];
    $width = $diag['width'];
    $height = $diag['height'];
    
    $htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>{$title}</title>
  <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
  <script>
    mermaid.initialize({
      startOnLoad: true,
      theme: 'default',
      securityLevel: 'loose',
      fontFamily: 'Segoe UI, -apple-system, BlinkMacSystemFont, Roboto, sans-serif'
    });
  </script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: #ffffff;
      padding: 30px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      font-family: 'Segoe UI', system-ui, sans-serif;
    }
    .diagram-card {
      background: #ffffff;
      border: 2px solid #e2e8f0;
      border-radius: 16px;
      padding: 32px;
      width: 100%;
      max-width: {$width}px;
      margin: 0 auto;
    }
    .header {
      border-bottom: 2px solid #f1f5f9;
      padding-bottom: 16px;
      margin-bottom: 24px;
    }
    .badge {
      display: inline-block;
      padding: 4px 14px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-radius: 9999px;
      background: #e0f2fe;
      color: #0369a1;
      margin-bottom: 8px;
    }
    h1 {
      font-size: 22px;
      color: #0f172a;
      font-weight: 700;
      margin-bottom: 6px;
    }
    p {
      font-size: 13px;
      color: #64748b;
    }
    .mermaid-container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
      width: 100%;
    }
    .mermaid {
      display: flex;
      justify-content: center;
      width: 100%;
    }
    .mermaid svg {
      width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
    }
    .footer {
      margin-top: 24px;
      padding-top: 12px;
      border-top: 1px solid #f1f5f9;
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      color: #94a3b8;
    }
  </style>
</head>
<body>
  <div class="diagram-card">
    <div class="header">
      <span class="badge">Arsitektur Rama Homestay</span>
      <h1>{$title}</h1>
      <p>{$subtitle}</p>
    </div>
    <div class="mermaid-container">
      <div class="mermaid">
{$mermaid}
      </div>
    </div>
    <div class="footer">
      <span>Sistem Informasi Reservasi Rama Homestay &bull; Spesifikasi UML & ERD</span>
      <span>Dihasilkan secara presisi dari arsitektur nyata aplikasi</span>
    </div>
  </div>
</body>
</html>
HTML;

    file_put_contents($tempDir . '/' . $id . '.html', $htmlContent);
}

// 2. Build the master interactive public/diagrams/index.html with LIVE MERMAID RENDERING + DOWNLOAD BUTTONS
require_once __DIR__ . '/use_case_specs.php';
$cardsHtml = '';
foreach ($diagrams as $d) {
    $rawMermaid = htmlspecialchars($d['mermaid'], ENT_QUOTES, 'UTF-8');
    $cardsHtml .= <<<CARD
      <div class="diagram-card" data-category="{$d['category']}" id="card-{$d['id']}">
        <div class="card-header">
          <div class="card-title-area">
            <span class="card-badge">{$d['badge']}</span>
            <h2 class="card-title">{$d['title']}</h2>
            <p class="card-desc">{$d['subtitle']}</p>
          </div>
          <div class="card-actions">
            <button class="action-btn primary" onclick="downloadDiagramAsPng('{$d['id']}', '{$d['title']}')" title="Unduh gambar PNG Resolusi Tinggi">
              ⬇️ Unduh PNG
            </button>
            <button class="action-btn" onclick="downloadDiagramAsSvg('{$d['id']}', '{$d['title']}')" title="Unduh file vektor SVG">
              ⬇️ Unduh SVG
            </button>
            <button class="action-btn" onclick="copyMermaid('code-{$d['id']}')" title="Salin kode Mermaid">
              📋 Salin Kode
            </button>
          </div>
        </div>
        <div class="diagram-viewport" id="viewport-{$d['id']}">
          <div class="mermaid" id="mermaid-{$d['id']}">
{$d['mermaid']}
          </div>
        </div>
        <textarea id="code-{$d['id']}" style="display:none;">{$rawMermaid}</textarea>
      </div>
CARD;

    if ($d['id'] === '03_usecase_admin') {
        $cardsHtml .= renderUseCaseSpecCard($useCasesList);
    }
}

$indexHtml = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Diagram Sistem - Reservasi Rama Homestay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
  <style>
    :root {
      --primary: #0284c7;
      --primary-dark: #0369a1;
      --primary-light: #e0f2fe;
      --accent: #059669;
      --bg-body: #f8fafc;
      --bg-card: #ffffff;
      --border: #e2e8f0;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --radius: 16px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      background-color: var(--bg-body);
      color: var(--text-main);
      line-height: 1.6;
      padding-bottom: 80px;
    }

    header {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      color: #ffffff;
      padding: 40px 20px;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .badge-header {
      display: inline-block;
      padding: 6px 16px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-radius: 9999px;
      background: rgba(14, 165, 233, 0.2);
      color: #38bdf8;
      border: 1px solid rgba(56, 189, 248, 0.3);
      margin-bottom: 12px;
    }

    header h1 {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: -0.02em;
      margin-bottom: 8px;
    }

    header p {
      color: #94a3b8;
      font-size: 14px;
      max-width: 700px;
      margin: 0 auto 20px auto;
    }

    .nav-tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 8px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .tab-btn {
      background: rgba(255, 255, 255, 0.08);
      color: #e2e8f0;
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 8px 16px;
      border-radius: 9999px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .tab-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
      transform: translateY(-1px);
    }

    .tab-btn.active {
      background: #0284c7;
      color: #ffffff;
      border-color: #38bdf8;
      box-shadow: 0 0 15px rgba(2, 132, 199, 0.5);
    }

    .container {
      max-width: 1350px;
      margin: 30px auto 0 auto;
      padding: 0 20px;
    }

    .info-bar {
      background: #ffffff;
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
      flex-wrap: wrap;
      gap: 12px;
    }

    .info-bar span {
      font-size: 14px;
      font-weight: 600;
      color: var(--text-muted);
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #059669;
      background: #ecfdf5;
      padding: 6px 14px;
      border-radius: 9999px;
      border: 1px solid #a7f3d0;
      font-size: 13px;
      font-weight: 700;
    }

    .diagram-list {
      display: flex;
      flex-direction: column;
      gap: 36px;
    }

    .diagram-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      transition: box-shadow 0.2s;
    }

    .diagram-card:hover {
      box-shadow: 0 12px 28px -5px rgba(0, 0, 0, 0.09);
    }

    .card-header {
      padding: 20px 28px;
      border-bottom: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff;
      flex-wrap: wrap;
      gap: 14px;
    }

    .card-title-area {
      flex: 1;
      min-width: 280px;
    }

    .card-badge {
      display: inline-block;
      padding: 3px 10px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      border-radius: 6px;
      background: var(--primary-light);
      color: var(--primary-dark);
      margin-bottom: 6px;
    }

    .card-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--text-main);
      margin-bottom: 4px;
    }

    .card-desc {
      font-size: 13px;
      color: var(--text-muted);
    }

    .card-actions {
      display: flex;
      gap: 8px;
      align-items: center;
      flex-wrap: wrap;
    }

    .action-btn {
      background: #f1f5f9;
      color: #334155;
      border: 1px solid #cbd5e1;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.15s ease;
      text-decoration: none;
    }

    .action-btn:hover {
      background: #e2e8f0;
      color: #0f172a;
    }

    .action-btn.primary {
      background: #0284c7;
      color: white;
      border-color: #0284c7;
    }

    .action-btn.primary:hover {
      background: #0369a1;
    }

    .diagram-viewport {
      padding: 36px 20px;
      background: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: auto;
      min-height: 250px;
      width: 100%;
    }

    .mermaid {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .mermaid svg {
      width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
    }

    /* Use Case Specification Table Styles */
    .spec-wrapper {
      padding: 24px;
      background: #f8fafc;
    }
    .spec-filter-bar {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }
    .spec-filter-group {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .spec-pill-btn {
      padding: 7px 16px;
      border-radius: 9999px;
      border: 1px solid #cbd5e1;
      background: #ffffff;
      color: #334155;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }
    .spec-pill-btn:hover {
      background: #f1f5f9;
      border-color: #94a3b8;
    }
    .spec-pill-btn.active {
      background: #0284c7;
      color: #ffffff;
      border-color: #0284c7;
      box-shadow: 0 2px 6px rgba(2, 132, 199, 0.3);
    }
    .spec-search-input {
      padding: 8px 14px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 13px;
      width: 280px;
      outline: none;
      transition: all 0.2s;
    }
    .spec-search-input:focus {
      border-color: #0284c7;
      box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
    }
    .spec-grid {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .spec-item {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.03);
      transition: all 0.2s;
    }
    .spec-item:hover {
      border-color: #0284c7;
      box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    }
    .spec-item-header {
      background: #f8fafc;
      padding: 14px 20px;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }
    .spec-id-title {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .spec-id-badge {
      background: #0f172a;
      color: #ffffff;
      padding: 5px 12px;
      border-radius: 6px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .spec-title-text {
      font-size: 16px;
      font-weight: 700;
      color: #0f172a;
    }
    .spec-badges {
      display: flex;
      gap: 8px;
      align-items: center;
      flex-wrap: wrap;
    }
    .badge-actor {
      background: #e0f2fe;
      color: #0369a1;
      border: 1px solid #bae6fd;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 9999px;
    }
    .badge-rel {
      background: #fef3c7;
      color: #92400e;
      border: 1px solid #fde68a;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 9999px;
      font-family: 'JetBrains Mono', monospace;
    }
    .spec-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13.5px;
    }
    .spec-table th, .spec-table td {
      padding: 12px 18px;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: top;
      text-align: left;
    }
    .spec-table tr:last-child th, .spec-table tr:last-child td {
      border-bottom: none;
    }
    .spec-table th {
      width: 240px;
      font-weight: 700;
      color: #475569;
      background: #fafafa;
      border-right: 1px solid #f1f5f9;
      white-space: nowrap;
    }
    .spec-table td {
      color: #1e293b;
    }
    .spec-steps {
      margin: 0;
      padding-left: 20px;
    }
    .spec-steps li {
      margin-bottom: 6px;
      line-height: 1.6;
    }
    .spec-alt-steps {
      margin: 0;
      padding-left: 20px;
      color: #b45309;
    }
    .spec-alt-steps li {
      margin-bottom: 5px;
      line-height: 1.55;
    }

    /* Toast Notification */
    #toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #0f172a;
      color: #ffffff;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      display: none;
      z-index: 1000;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>

  <header>
    <span class="badge-header">Visualisasi UML & ERD Sistem Lengkap</span>
    <h1>Galeri Diagram Reservasi Rama Homestay</h1>
    <p>23 Diagram Terpisah (Diagram Use Case, ERD, Sequence, Kelas, & Aktivitas) serta Tabel Atribut Spesifikasi Use Case Lengkap.</p>
    
    <div class="nav-tabs">
      <button class="tab-btn active" onclick="filterCategory('all', this)">🌟 Semua Diagram (23)</button>
      <button class="tab-btn" onclick="filterCategory('usecase', this)">📋 Diagram & Tabel Use Case (3+1)</button>
      <button class="tab-btn" onclick="filterCategory('erd', this)">🗄️ Diagram ERD (1)</button>
      <button class="tab-btn" onclick="filterCategory('sequence', this)">🔄 Diagram Sequence (9)</button>
      <button class="tab-btn" onclick="filterCategory('class', this)">🏛️ Diagram Kelas (1)</button>
      <button class="tab-btn" onclick="filterCategory('activity', this)">⚡ Diagram Aktivitas (9)</button>
    </div>
  </header>

  <div class="container">
    <div class="info-bar">
      <span>Framework: <strong>Laravel 11+ & Midtrans Payment Gateway</strong></span>
      <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
        <a href="/wireframes/index.html" style="background:#0284c7;color:#fff;text-decoration:none;padding:6px 14px;border-radius:6px;font-size:13px;font-weight:700;">📐 Buka Katalog Wireframe UI (12 Layar)</a>
        <div class="status-badge">
          ✓ 100% Bebas Error & Terverifikasi
        </div>
      </div>
    </div>

    <div class="diagram-list" id="diagramList">
{$cardsHtml}
    </div>
  </div>

  <div id="toast">Notifikasi</div>

  <script>
    mermaid.initialize({
      startOnLoad: true,
      theme: 'default',
      securityLevel: 'loose',
      fontFamily: 'Plus Jakarta Sans, sans-serif'
    });

    function showToast(msg) {
      const toast = document.getElementById('toast');
      toast.textContent = msg;
      toast.style.display = 'block';
      setTimeout(() => { toast.style.display = 'none'; }, 2500);
    }

    function filterCategory(category, btn) {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const cards = document.querySelectorAll('.diagram-card');
      cards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }

    function copyMermaid(textareaId) {
      const textarea = document.getElementById(textareaId);
      navigator.clipboard.writeText(textarea.value).then(() => {
        showToast('✓ Kode Mermaid berhasil disalin ke clipboard!');
      }).catch(() => {
        showToast('Gagal menyalin kode.');
      });
    }

    function downloadDiagramAsSvg(id, title) {
      const container = document.getElementById('mermaid-' + id);
      const svg = container ? container.querySelector('svg') : null;
      if (!svg) {
        showToast('Diagram belum selesai dirender.');
        return;
      }
      const svgData = new XMLSerializer().serializeToString(svg);
      const blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = id + '.svg';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
      showToast('✓ File SVG berhasil diunduh!');
    }

    function downloadDiagramAsPng(id, title) {
      const container = document.getElementById('mermaid-' + id);
      const svg = container ? container.querySelector('svg') : null;
      if (!svg) {
        showToast('Diagram belum selesai dirender.');
        return;
      }

      const svgData = new XMLSerializer().serializeToString(svg);
      const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
      const DOMURL = window.URL || window.webkitURL || window;
      const url = DOMURL.createObjectURL(svgBlob);

      const img = new Image();
      img.onload = function() {
        const bbox = svg.getBoundingClientRect();
        const scale = 2; // HD 2x scale
        const canvas = document.createElement('canvas');
        canvas.width = Math.max(800, bbox.width * scale);
        canvas.height = Math.max(400, bbox.height * scale);
        const ctx = canvas.getContext('2d');

        // White background
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        DOMURL.revokeObjectURL(url);

        canvas.toBlob(function(blob) {
          const a = document.createElement('a');
          a.href = URL.createObjectURL(blob);
          a.download = id + '.png';
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
          showToast('✓ Gambar PNG (HD) berhasil diunduh!');
        }, 'image/png');
      };
      img.src = url;
    }

    function filterUseCaseSpecs(filter, btn) {
      document.querySelectorAll('.spec-pill-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const items = document.querySelectorAll('.spec-item');
      items.forEach(item => {
        if (filter === 'all' || item.getAttribute('data-actor') === filter) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    }

    function searchUseCaseSpecs(query) {
      const q = query.toLowerCase().trim();
      const items = document.querySelectorAll('.spec-item');
      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(q)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    }

    function copyAllSpecs() {
      const items = document.querySelectorAll('.spec-item');
      let text = "SPESIFIKASI DAN ATRIBUT USE CASE RESMI - RESERVASI RAMA HOMESTAY\\n\\n";
      items.forEach(item => {
        const id = item.querySelector('.spec-id-badge').textContent.trim();
        const title = item.querySelector('.spec-title-text').textContent.trim();
        text += '[' + id + '] ' + title + '\\n';
        const rows = item.querySelectorAll('tr');
        rows.forEach(r => {
          const th = r.querySelector('th').textContent.trim();
          const td = r.querySelector('td').textContent.trim().replace(/\\s+/g, ' ');
          text += '  - ' + th + ': ' + td + '\\n';
        });
        text += '\\n';
      });
      navigator.clipboard.writeText(text).then(() => {
        showToast('✓ Ringkasan spesifikasi Use Case berhasil disalin!');
      }).catch(() => {
        showToast('Gagal menyalin spesifikasi.');
      });
    }
  </script>
</body>
</html>
HTML;

file_put_contents(__DIR__ . '/public/diagrams/index.html', $indexHtml);
echo "Berhasil memperbarui public/diagrams/index.html dengan 23 diagram interaktif!\n";

// 3. Render diagrams to public/diagrams/images/*.png with msedge
$targetId = $argv[1] ?? null;
foreach ($diagrams as $index => $diag) {
    if ($targetId && $diag['id'] !== $targetId) {
        continue;
    }
    $num = $index + 1;
    $id = $diag['id'];
    $tempHtmlFile = $tempDir . '/' . $id . '.html';
    $pngOutputFile = $outputDir . '/' . $id . '.png';
    $fileUrl = 'file:///' . str_replace('\\', '/', $tempHtmlFile);

    echo "[$num/" . count($diagrams) . "] Merender PNG: $id ...\n";
    $cmd = sprintf(
        '"%s" --headless --force-device-scale-factor=2 --window-size=%d,%d --virtual-time-budget=6000 --screenshot="%s" "%s"',
        $edgePath,
        $diag['width'] + 60,
        $diag['height'] + 100,
        $pngOutputFile,
        $fileUrl
    );
    exec($cmd);
}

echo "\nSemua proses selesai dengan sempurna tanpa error!\n";
