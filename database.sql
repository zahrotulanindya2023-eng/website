-- =====================================================
-- Database: website_profil_organisasi
-- Organisasi: Himpunan Mahasiswa Statistika (HMSS)
-- =====================================================

CREATE DATABASE IF NOT EXISTS website_profil_organisasi
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE website_profil_organisasi;

-- -----------------------------------------------------
-- Tabel users (login admin)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','editor') DEFAULT 'editor',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabel members (profil anggota / tim inti)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  role VARCHAR(100) NOT NULL,
  photo VARCHAR(255) DEFAULT 'default-avatar.png',
  bio TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabel events (galeri kegiatan)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  date DATE NOT NULL,
  description TEXT,
  image VARCHAR(255) DEFAULT 'default-event.jpg',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabel news (berita atau artikel)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  content LONGTEXT NOT NULL,
  image VARCHAR(255) DEFAULT 'default-news.jpg',
  date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Tabel contacts (pesan dari pengguna)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- DATA SAMPLE
-- =====================================================

-- Admin default (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@HMSS.uny.ac.id', '$2y$10$/yqOvxwmeosmdP0JNogb.uma7T9IH2ki92q1muXME2gaNjQABjnXq', 'admin');

-- Sample Members
INSERT INTO members (name, role, photo, bio) VALUES
('Nama Ketua Umum', 'Ketua Umum', 'member1.jpg', 'Mahasiswa Statistika semester 6 yang berpengalaman dalam kepemimpinan organisasi.'),
('Nama Wakil Ketua', 'Wakil Ketua', 'member2.jpg', 'Mahasiswa aktif yang fokus pada pengembangan sumber daya manusia di bidang teknologi.'),
('Nama Sekretasis Umum', 'Sekretaris Umum', 'member3.jpg', 'Bertanggung jawab atas administrasi dan dokumentasi kegiatan organisasi.'),
('Nama Bendahara Umum', 'Bendahara Umum', 'member4.jpg', 'Mengelola keuangan dan laporan anggaran organisasi secara transparan.'),
('Nama Ketua Divisi Akademik', 'Ketua Divisi Akademik', 'member5.jpg', 'Mengkoordinasikan kegiatan akademik dan pengembangan keilmuan anggota.'),
('Nama Ketua Divisi Humas', 'Ketua Divisi Humas', 'member6.jpg', 'Mengelola komunikasi eksternal dan hubungan masyarakat organisasi.');

-- Sample Events (Galeri)
INSERT INTO events (title, date, description, image) VALUES
('Workshop Machine Learning', '2025-03-15', 'Workshop intensif tentang dasar-dasar Machine Learning dan implementasinya menggunakan Python dan TensorFlow.', 'event1.jpg'),
('Seminar Nasional Teknologi', '2025-04-20', 'Seminar nasional yang menghadirkan pembicara dari industri teknologi terkemuka di Indonesia.', 'event2.jpg'),
('Hackathon HMSS 2025', '2025-05-10', 'Kompetisi hackathon 24 jam yang diikuti oleh lebih dari 50 tim dari berbagai universitas.', 'event3.jpg'),
('Pelatihan Laravel Framework', '2025-06-05', 'Pelatihan pengembangan web menggunakan framework Laravel untuk anggota HMSS.', 'event4.jpg'),
('Kunjungan Industri ke Jakarta', '2025-07-12', 'Kunjungan ke perusahaan teknologi terkemuka di Jakarta untuk memperluas wawasan anggota.', 'event5.jpg'),
('Lomba Desain UI/UX', '2025-08-18', 'Kompetisi desain antarmuka pengguna yang kreatif dan inovatif tingkat mahasiswa.', 'event6.jpg');

-- Sample News
INSERT INTO news (title, content, image, date) VALUES
('HMSS Raih Juara 1 Hackathon Nasional 2025', 'Himpunan Mahasiswa Statistika (HMSS) berhasil meraih Juara 1 dalam ajang Hackathon Nasional 2025 yang diselenggarakan di Jakarta. Tim HMSS yang terdiri dari lima mahasiswa berhasil mengembangkan aplikasi pemantau kualitas udara berbasis IoT dalam waktu 24 jam.\n\nKeberhasilan ini merupakan bukti nyata dari komitmen HMSS dalam mengembangkan kemampuan teknologi para anggotanya. Ketua Umum HMSS, Budi Santoso, menyatakan bahwa pencapaian ini adalah hasil dari kerja keras dan latihan intensif selama beberapa bulan.\n\n"Kami sangat bangga dengan pencapaian ini. Ini bukan hanya kemenangan bagi tim, tetapi juga bagi seluruh keluarga besar HMSS," ujar Budi Santoso.', 'news1.jpg', '2025-09-01'),
('Pendaftaran Anggota Baru HMSS Periode 2025/2026 Dibuka', 'HMSS resmi membuka pendaftaran anggota baru untuk periode kepengurusan 2025/2026. Pendaftaran dibuka mulai tanggal 1 Oktober hingga 31 Oktober 2025.\n\nCalon anggota dapat mendaftar melalui website resmi HMSS atau langsung ke sekretariat yang berlokasi di Gedung Statistika lantai 2. Persyaratan pendaftaran meliputi fotokopi KTM, pas foto 3x4, dan mengisi formulir pendaftaran yang tersedia.\n\nSesi orientasi akan dilaksanakan pada tanggal 5 November 2025 bertempat di Aula Fakultas Teknik.', 'news2.jpg', '2025-09-15'),
('Workshop Keamanan Siber: Melindungi Data di Era Digital', 'HMSS bekerja sama dengan Badan Siber dan Sandi Negara (BSSN) menyelenggarakan Workshop Keamanan Siber yang akan dilaksanakan pada 20 Oktober 2025.\n\nWorkshop ini akan membahas tentang ancaman keamanan siber terkini, teknik pencegahan serangan, dan cara melindungi data pribadi di era digital. Pembicara tamu dari BSSN dan praktisi keamanan siber telah dikonfirmasi untuk hadir.\n\nKapasitas terbatas untuk 100 peserta. Segera daftarkan diri Anda melalui link pendaftaran yang tersedia di media sosial HMSS.', 'news3.jpg', '2025-09-20'),
('HMSS Luncurkan Program Mentoring Mahasiswa Baru', 'Sebagai bentuk komitmen dalam mendukung mahasiswa baru, HMSS meluncurkan Program Mentoring yang akan menghubungkan mahasiswa semester awal dengan mahasiswa senior yang berpengalaman.\n\nProgram ini dirancang untuk membantu mahasiswa baru beradaptasi dengan kehidupan kampus, memberikan bimbingan akademik, dan memperkenalkan peluang pengembangan diri di bidang teknologi informasi.\n\nSetiap mahasiswa baru akan mendapatkan satu mentor yang akan membimbing mereka selama satu semester penuh.', 'news4.jpg', '2025-10-01');
