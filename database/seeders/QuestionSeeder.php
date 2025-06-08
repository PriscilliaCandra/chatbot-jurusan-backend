<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // Level 1: Dunia Minat
            [
                'level' => '1',
                'question_text' => 'Jika kamu punya satu hari bebas di dunia ini, kamu akan…',
                'option_a' => 'Menyusun teka-teki besar di kuil logika',
                'option_b' => 'Melukis mural langit di Kuil Seni',
                'option_c' => 'Menjual ide bisnis ke Raja Dagang',
                'option_d' => 'Debat terbuka di Balai Rakyat',
                'option_e' => 'Membantu anak-anak belajar di Hutan Cerita',
                'question_order' => 1
            ],
            [
                'level' => '1',
                'question_text' => 'Kamu mendapatkan tongkat ajaib. Saat kamu goyangkan, dia menampilkan profesi masa depanmu:',
                'option_a' => 'Peneliti canggih',
                'option_b' => 'Arsitek imajinasi',
                'option_c' => 'Investor kerajaan',
                'option_d' => 'Diplomat antarwilayah',
                'option_e' => 'Penjaga jiwa',
                'question_order' => 2
            ],
            [
                'level' => '1',
                'question_text' => 'Di Perpustakaan Minat, kamu hanya bisa bawa satu buku. Kamu ambil...',
                'option_a' => 'Rumus tersembunyi semesta',
                'option_b' => 'Seni membentuk realita',
                'option_c' => 'Rahasia menjadi pemimpin hebat',
                'option_d' => 'Cara memenangkan diskusi',
                'option_e' => 'Bahasa perasaan',
                'question_order' => 3
            ],
            [
                'level' => '1',
                'question_text' => 'Seekor naga menawarkan skill spesial. Kamu pilih...',
                'option_a' => 'Bisa memecahkan masalah kompleks',
                'option_b' => 'Bisa menciptakan hal indah dari apa pun',
                'option_c' => 'Bisa membaca pola keuangan',
                'option_d' => 'Bisa mempengaruhi opini orang',
                'option_e' => 'Bisa menyembuhkan luka batin',
                'question_order' => 4
            ],
            [
                'level' => '1',
                'question_text' => 'Di ruang ilusi, kamu ditampilkan sebagai karakter game. Kamu muncul sebagai...',
                'option_a' => 'Engineer berpikiran tajam',
                'option_b' => 'Seniman dengan kuas sihir',
                'option_c' => 'CEO muda dari kerajaan startup',
                'option_d' => 'Ksatria debat kerajaan',
                'option_e' => 'Penyembuh yang dicintai',
                'question_order' => 5
            ],
            [
                'level' => '1',
                'question_text' => 'Kamu menjelajahi Pasar Waktu, tiap toko menampilkan kegiatan idealmu seumur hidup. Kamu langsung masuk ke...',
                'option_a' => 'Toko Riset & Penemuan',
                'option_b' => 'Galeri Ilusi Visual',
                'option_c' => 'Bursa Ide & Inovasi',
                'option_d' => 'Studio Debat Interaktif',
                'option_e' => 'Ruang Baca Anak-Anak',
                'question_order' => 6
            ],
            [
                'level' => '1',
                'question_text' => 'Di Taman Pilihan, kamu duduk di bawah pohon yang berbisik. Ia berkata: “Impian terbesar kamu adalah...',
                'option_a' => 'Menemukan hukum alam baru',
                'option_b' => 'Membuat karya tak terlupakan',
                'option_c' => 'Membangun usaha yang berdampak',
                'option_d' => 'Mempengaruhi kebijakan dunia',
                'option_e' => 'Membahagiakan orang-orang sekitarmu',
                'question_order' => 7
            ],
            [
                'level' => '1',
                'question_text' => 'Sebuah kotak harta muncul di hadapanmu. Isinya...',
                'option_a' => 'Blueprint mesin masa depan',
                'option_b' => 'Kuas lukisan bercahaya',
                'option_c' => 'Kartu emas bisnis global',
                'option_d' => 'Mikrofon debat tanpa cela',
                'option_e' => 'Surat terima kasih dari anak-anak',
                'question_order' => 8
            ],
            [
                'level' => '1',
                'question_text' => 'Di Kuil Diri, kamu diminta menggambarkan momen paling menyenangkan hidupmu...',
                'option_a' => 'Saat berhasil menyelesaikan tantangan logika',
                'option_b' => 'Saat membuat sesuatu yang menginspirasi',
                'option_c' => 'Saat idemu diapresiasi banyak orang',
                'option_d' => 'Saat berhasil meyakinkan seseorang',
                'option_e' => 'Saat ada yang tersenyum karena uluranmu',
                'question_order' => 9
            ],
            [
                'level' => '1',
                'question_text' => 'Di Pintu Tiga Jalan, kamu hanya bisa pilih satu portal...',
                'option_a' => 'Lab Sains Ajaib',
                'option_b' => 'Studio Impian Virtual',
                'option_c' => 'Menara Strategi Dagang',
                'option_d' => 'Aula Pidato Terbuka',
                'option_e' => 'Taman Damai Jiwa',
                'question_order' => 10
            ],
            [
                'level' => '1',
                'question_text' => 'Dewa Minat menantangmu dengan satu pertanyaan terakhir: “Jika dunia ini membutuhkan peranmu, kamu ingin dikenal sebagai...',
                'option_a' => 'Pemikir tajam',
                'option_b' => 'Pencipta keindahan',
                'option_c' => 'Pengubah sistem',
                'option_d' => 'Penggerak opini',
                'option_e' => 'Penguat hati',
                'question_order' => 11
            ],
            [
                'level' => '1',
                'question_text' => 'Terakhir, kamu menulis pesan di Batu Takdir: “Aku ingin masa depanku diisi dengan...',
                'option_a' => 'Tantangan intelektual',
                'option_b' => 'Ekspresi & estetika',
                'option_c' => 'Keberanian membangun hal baru',
                'option_d' => 'Pertarungan ide & visi',
                'option_e' => 'Kehangatan dan makna antar manusia',
                'question_order' => 12
            ],
            
            // Level 2: Arena Bakat
            [
                'level' => '2',
                'question_text' => 'Kamu berada di Labirin Logika. Untuk keluar, kamu harus...',
                'option_a' => 'Hitung rute tercepat dengan rumus',
                'option_b' => 'Gambar peta jalan dari simbol',
                'option_c' => 'Organisir tim pecah jadi 3 jalur',
                'option_d' => 'Tanya penjaga labirin lewat debat',
                'option_e' => 'Dengarkan suara hati tiap jalur',
                'question_order' => 1
            ],
            [
                'level' => '2',
                'question_text' => 'Raja meminta kamu mendesain festival. Kamu bertugas...',
                'option_a' => 'Bangun sistem pencahayaan efisien',
                'option_b' => 'Buat dekorasi panggung megah',
                'option_c' => 'Atur jadwal & anggaran',
                'option_d' => 'Jadi pembawa acara utama',
                'option_e' => 'Menjaga pengunjung dengan tenang',
                'question_order' => 2
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu dapat teka-teki: “Jika 5 penyihir membuat 5 ramuan dalam 5 jam, berapa waktu untuk 100 ramuan?”',
                'option_a' => '100 jam',
                'option_b' => '20 jam',
                'option_c' => '5 jam ',
                'option_d' => '10 jam',
                'option_e' => 'Hah? Aku buat visualnya aja',
                'question_order' => 3
            ],
            [
                'level' => '2',
                'question_text' => 'Dalam Tantangan Menara Pasir, kamu harus menyusun rencana membangun menara tinggi di tepi pantai. Strategimu adalah...',
                'option_a' => 'Hitung struktur dan tekanan material',
                'option_b' => 'Rancang bentuk indah & unik',
                'option_c' => 'Atur tim & bahan supaya efisien',
                'option_d' => 'Presentasi ide agar semua setuju',
                'option_e' => 'Pastikan semua nyaman & aman saat membangun',
                'question_order' => 4
            ],
            [
                'level' => '2',
                'question_text' => 'Pasukanmu bingung saat menyerang kastil musuh. Kamu...',
                'option_a' => 'Buat skema strategi terperinci',
                'option_b' => 'Ciptakan alat penyamaran visual',
                'option_c' => 'Tunjuk peran tim sesuai kemampuan',
                'option_d' => 'Negosiasi agar musuh menyerah',
                'option_e' => 'Cek kondisi emosional pasukan dulu',
                'question_order' => 5
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu diajak masuk “Simulasi Bisnis Talenthia”. Kamu diminta buat produk. Ide pertamamu adalah...',
                'option_a' => 'Aplikasi analisis data cuaca',
                'option_b' => 'Perhiasan dari cahaya bulan',
                'option_c' => 'Platform kursus kerajaan online',
                'option_d' => 'Media debat interaktif',
                'option_e' => 'Jurnal pribadi berbasis emosi',
                'question_order' => 6
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu ikut lomba menciptakan peta dunia baru. Kamu unggul karena...',
                'option_a' => 'Peta kamu sangat akurat dan berbasis perhitungan',
                'option_b' => 'Visualisasimu luar biasa indah',
                'option_c' => 'Kamu atur pembuatan tim dengan cepat',
                'option_d' => 'Kamu mempresentasikan peta dengan kuat',
                'option_e' => 'Kamu tambahkan lokasi-lokasi aman & tenang',
                'question_order' => 7
            ],
            [
                'level' => '2',
                'question_text' => 'Raja meminta pidato kebangsaan. Kamu jadi tim kreatif. Bagianmu adalah...',
                'option_a' => 'Buat data & fakta pendukung pidato',
                'option_b' => 'Desain visual latar belakang & musik',
                'option_c' => 'Buat jadwal dan susunan acara',
                'option_d' => 'Tulis naskah pidato utama',
                'option_e' => 'Jaga suasana agar audiens merasa dihargai',
                'question_order' => 8
            ],
            [
                'level' => '2',
                'question_text' => 'Di Balapan Intelektual, kamu harus menolong tim memecahkan masalah. Kamu jadi...',
                'option_a' => 'Ahli logika & rumus',
                'option_b' => 'Kreator alat bantu',
                'option_c' => 'Koordinator waktu dan tugas',
                'option_d' => 'Penyemangat dengan retorika',
                'option_e' => 'Pendengar masalah rekan tim',
                'question_order' => 9
            ],
            [
                'level' => '2',
                'question_text' => 'Festival Seni Talenthia butuh kamu membuat karya. Kamu memilih...',
                'option_a' => 'Animasi edukasi fisika',
                'option_b' => 'Lukisan raksasa interaktif',
                'option_c' => 'Pameran bisnis anak muda',
                'option_d' => 'Teater isu sosial',
                'option_e' => 'Instalasi tentang emosi dan trauma',
                'question_order' => 10
            ],
            [
                'level' => '2',
                'question_text' => 'Dalam misi diplomatik ke negeri lain, kamu ditugaskan...',
                'option_a' => 'Menyiapkan argumen dan data kuat',
                'option_b' => 'Membuat simbol-simbol budaya',
                'option_c' => 'Atur strategi pertemuan lintas tim',
                'option_d' => 'Jadi juru bicara utama',
                'option_e' => 'Menangani konflik emosional selama misi',
                'question_order' => 11
            ],
            [
                'level' => '2',
                'question_text' => 'Di akhir arena, kamu menghadapi “Tes Dirimu”. Kamu disuruh memilih kekuatan utama tim impianmu. Kamu pilih...',
                'option_a' => 'Otak jenius dan hitungan cepat',
                'option_b' => 'Imajinasi & daya cipta',
                'option_c' => 'Manajemen dan eksekusi',
                'option_d' => 'Komunikasi dan pengaruh',
                'option_e' => 'Empati dan penyembuhan',
                'question_order' => 12
            ],
            
            // Level 3: Cermin Dirimu
            [
                'level' => '3',
                'question_text' => 'Di tengah malam, kamu sendiri. Tiba-tiba cermin bertanya: “Hal paling membuatmu puas adalah…”',
                'option_a' => 'Temukan pola tersembunyi',
                'option_b' => 'Ciptakan keindahan yang belum pernah ada',
                'option_c' => 'Lihat ide kamu jadi nyata',
                'option_d' => 'Saat argumen kamu meyakinkan',
                'option_e' => 'Saat orang merasa pulih karena kamu',
                'question_order' => 1,
            ],
            [
                'level' => '3',
                'question_text' => 'Di Cermin Waktu, kamu melihat dirimu di masa depan...',
                'option_a' => 'Penemu AI kesehatan',
                'option_b' => 'Ilustrator buku anak-anak terkenal',
                'option_c' => 'Founder startup pendidikan',
                'option_d' => 'Pembicara TEDx soal keadilan',
                'option_e' => 'Konselor sekolah internasional',
                'question_order' => 2,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu menemukan kunci emas. Tapi hanya bisa dipakai jika kamu tahu nilai hidupmu. Kamu pilih:',
                'option_a' => 'Logika',
                'option_b' => 'Imajinasi',
                'option_c' => 'Strategi',
                'option_d' => 'Keadilan',
                'option_e' => 'Kepedulian',
                'question_order' => 3,
            ],
            [
                'level' => '3',
                'question_text' => 'Suara hati dalam cermin berkata: “Ketika kamu terluka, kamu cenderung…”',
                'option_a' => 'Menganalisis kenapa itu terjadi',
                'option_b' => 'Mengalihkan rasa lewat karya',
                'option_c' => 'Menyusun rencana pemulihan',
                'option_d' => 'Membela diri dengan kata-kata',
                'option_e' => 'Diam dan mendengarkan hati sendiri',
                'question_order' => 4,
            ],
            [
                'level' => '3',
                'question_text' => 'Dalam cermin jiwa, kamu melihat masa kecilmu. Hal yang paling kamu sukai saat itu adalah…',
                'option_a' => 'Bermain teka-teki dan eksperimen kecil',
                'option_b' => 'Menggambar dan mendongeng',
                'option_c' => 'Jualan mainan buatan sendiri',
                'option_d' => 'Jadi pemimpin permainan kelompok',
                'option_e' => 'Membantu teman yang sedih',
                'question_order' => 5,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu diminta memberi nasihat ke dirimu 5 tahun lalu. Kamu akan bilang:',
                'option_a' => '“Terus cari pola dan jangan berhenti penasaran.”',
                'option_b' => '“Dunia butuh sentuhan keunikanmu.”',
                'option_c' => '“Ambil risiko, dan buat langkahmu sendiri.”',
                'option_d' => '“Suaramu berharga, jangan diam.”',
                'option_e' => '“Jaga hatimu, kamu juga pantas bahagia.”',
                'question_order' => 6,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu membuka surat dari masa depan, isinya satu pujian yang kamu inginkan.',
                'option_a' => '“Kamu jenius dan solutif.”',
                'option_b' => '“Karyamu menginspirasi dunia.”',
                'option_c' => '“Kamu mengubah sistem pendidikan.”',
                'option_d' => '“Kamu bikin perubahan nyata lewat kata-kata.”',
                'option_e' => '“Kamu menyelamatkan banyak jiwa.”',
                'question_order' => 7,
            ],
            [
                'level' => '3',
                'question_text' => 'Di ruang perenungan, kamu ditanya: Jika kamu tidak pernah dinilai siapa pun, kamu akan…',
                'option_a' => 'Menulis teori-teori baru',
                'option_b' => 'Menciptakan dunia visual dan cerita',
                'option_c' => 'Menjalankan proyek ambisius',
                'option_d' => 'Membuat komunitas berpikir kritis',
                'option_e' => 'Berkeliling membantu orang secara sukarela',
                'question_order' => 8,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu bertemu dirimu yang paling “otentik”. Dia bilang:',
                'option_a' => '“Aku hidup untuk menemukan kebenaran.”',
                'option_b' => '“Aku hidup untuk mencipta dan menginspirasi.”',
                'option_c' => '“Aku hidup untuk mengubah sistem.”',
                'option_d' => '“Aku hidup untuk menyuarakan keadilan.”',
                'option_e' => '“Aku hidup untuk menyembuhkan.”',
                'question_order' => 9,
            ],
            [
                'level' => '3',
                'question_text' => 'Dalam ritual terakhir, kamu menulis satu kata yang ingin dunia ingat darimu:',
                'option_a' => 'Cerdas',
                'option_b' => 'Unik',
                'option_c' => 'Visioner',
                'option_d' => 'Berani',
                'option_e' => 'Tulus',
                'question_order' => 10,
            ],
            [
                'level' => '3',
                'question_text' => 'Jiwa kamu dipantulkan ke lima warna cahaya. Kamu tertarik dengan…',
                'option_a' => 'Biru dingin penuh perhitungan',
                'option_b' => 'Ungu terang penuh imajinasi',
                'option_c' => 'Emas bersinar penuh rencana',
                'option_d' => 'Merah tajam penuh semangat',
                'option_e' => 'Hijau lembut penuh ketenangan',
                'question_order' => 11,
            ],
            [
                'level' => '3',
                'question_text' => 'Saat kamu akhirnya keluar dari Cermin Shavira, kamu membawa satu benda jiwa:',
                'option_a' => 'Kompas logika',
                'option_b' => 'Kuas ciptaan',
                'option_c' => 'Blueprint strategi',
                'option_d' => 'Tongkat orator',
                'option_e' => 'Kristal perasaan',
                'question_order' => 12,
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
} 