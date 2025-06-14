<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotQuestion;

class ChatbotSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // Pertanyaan untuk kepribadian Logis
            [
                'questions' => 'Jurusan apa yang cocok untuk kepribadian Logis?',
                'answer' => 'Jurusan yang cocok untuk kepribadian Logis:
                1. Teknik Informatika
                2. Matematika
                3. Statistika
                4. Teknik Elektro
                5. Teknik Mesin
                6. Teknik Industri
                7. Aktuaria
                8. Ilmu Komputer

                Tips: Fokus pada jurusan yang membutuhkan analisis, pemecahan masalah, dan logika yang kuat.',
                'personality_type' => 'Logis'
            ],
            [
                'questions' => 'Bagaimana cara belajar efektif untuk kepribadian Logis?',
                'answer' => 'Tips belajar efektif untuk kepribadian Logis:
                1. Buat jadwal belajar terstruktur
                2. Pecah materi menjadi bagian-bagian logis
                3. Buat mind mapping untuk menghubungkan konsep
                4. Latih pemecahan masalah secara sistematis
                5. Diskusikan dengan teman untuk memperdalam pemahaman
                6. Gunakan metode belajar yang terukur dan terstruktur',
                'personality_type' => 'Logis'
            ],
            [
                'questions' => 'Apa kelebihan kepribadian Logis dalam dunia kerja?',
                'answer' => 'Kelebihan kepribadian Logis dalam dunia kerja:
                1. Analisis data yang kuat
                2. Pemecahan masalah sistematis
                3. Pengambilan keputusan berdasarkan fakta
                4. Kemampuan berpikir kritis
                5. Detail-oriented
                6. Efisiensi dalam bekerja
                7. Kemampuan troubleshooting
                8. Logika yang kuat',
                'personality_type' => 'Logis'
            ],
            [
                'questions' => 'Bagaimana cara mengembangkan skill kepribadian Logis?',
                'answer' => 'Cara mengembangkan skill kepribadian Logis:
                1. Latih kemampuan analisis dengan puzzle dan games
                2. Pelajari bahasa pemrograman
                3. Ikut kompetisi matematika/logika
                4. Baca buku-buku sains dan teknologi
                5. Praktik pemecahan masalah sehari-hari
                6. Ikut workshop data analysis
                7. Bergabung dengan komunitas tech',
                'personality_type' => 'Logis'
            ],

            // Pertanyaan untuk kepribadian Kreatif
            [
                'questions' => 'Jurusan apa yang cocok untuk kepribadian Kreatif?',
                'answer' => 'Jurusan yang cocok untuk kepribadian Kreatif:
                1. Desain Komunikasi Visual
                2. Arsitektur
                3. Seni Rupa
                4. Desain Interior
                5. Film dan Televisi
                6. Fashion Design
                7. Desain Produk
                8. Ilmu Komunikasi

                Tips: Pilih jurusan yang memungkinkan Anda mengekspresikan kreativitas dan inovasi.',
                'personality_type' => 'Kreatif'
            ],
            [
                'questions' => 'Bagaimana cara belajar efektif untuk kepribadian Kreatif?',
                'answer' => 'Tips belajar efektif untuk kepribadian Kreatif:
                1. Buat catatan dengan visualisasi dan warna
                2. Gunakan metode belajar yang menyenangkan
                3. Cari cara unik untuk memahami materi
                4. Gabungkan teori dengan praktik kreatif
                5. Buat proyek pribadi untuk mengaplikasikan ilmu
                6. Bergabung dengan komunitas kreatif',
                'personality_type' => 'Kreatif'
            ],
            [
                'questions' => 'Apa kelebihan kepribadian Kreatif dalam dunia kerja?',
                'answer' => 'Kelebihan kepribadian Kreatif dalam dunia kerja:
                1. Pemikiran out of the box
                2. Kemampuan visualisasi yang kuat
                3. Inovasi dalam problem solving
                4. Adaptif terhadap perubahan
                5. Kemampuan presentasi yang menarik
                6. Ide-ide segar dan unik
                7. Kemampuan storytelling
                8. Sensitif terhadap estetika',
                'personality_type' => 'Kreatif'
            ],
            [
                'questions' => 'Bagaimana cara mengembangkan skill kepribadian Kreatif?',
                'answer' => 'Cara mengembangkan skill kepribadian Kreatif:
                1. Latih kemampuan menggambar dan desain
                2. Ikut workshop seni dan kreativitas
                3. Eksplorasi berbagai media kreatif
                4. Buat portofolio karya
                5. Ikut kompetisi desain
                6. Bergabung dengan komunitas kreatif
                7. Pelajari software desain',
                'personality_type' => 'Kreatif'
            ],

            // Pertanyaan untuk kepribadian Strategis
            [
                'questions' => 'Jurusan apa yang cocok untuk kepribadian Strategis?',
                'answer' => 'Jurusan yang cocok untuk kepribadian Strategis:
                1. Manajemen Bisnis
                2. Ekonomi
                3. Hubungan Internasional
                4. Ilmu Politik
                5. Teknik Industri
                6. Manajemen Informatika
                7. Sistem Informasi
                8. Manajemen Perhotelan

                Tips: Pilih jurusan yang membutuhkan perencanaan dan pengambilan keputusan strategis.',
                'personality_type' => 'Strategis'
            ],
            [
                'questions' => 'Bagaimana cara belajar efektif untuk kepribadian Strategis?',
                'answer' => 'Tips belajar efektif untuk kepribadian Strategis:
                1. Buat rencana belajar jangka panjang
                2. Tetapkan tujuan dan target yang jelas
                3. Analisis metode belajar yang paling efektif
                4. Manajemen waktu yang baik
                5. Evaluasi hasil belajar secara berkala
                6. Bergabung dengan organisasi kampus',
                'personality_type' => 'Strategis'
            ],
            [
                'questions' => 'Apa kelebihan kepribadian Strategis dalam dunia kerja?',
                'answer' => 'Kelebihan kepribadian Strategis dalam dunia kerja:
                1. Perencanaan yang matang
                2. Pengambilan keputusan yang tepat
                3. Manajemen risiko yang baik
                4. Kemampuan analisis pasar
                5. Leadership yang kuat
                6. Problem solving strategis
                7. Adaptif terhadap perubahan
                8. Kemampuan negosiasi',
                'personality_type' => 'Strategis'
            ],
            [
                'questions' => 'Bagaimana cara mengembangkan skill kepribadian Strategis?',
                'answer' => 'Cara mengembangkan skill kepribadian Strategis:
                1. Latih kemampuan analisis pasar
                2. Ikut organisasi kampus
                3. Pelajari case study bisnis
                4. Ikut kompetisi bisnis
                5. Magang di perusahaan
                6. Bergabung dengan komunitas entrepreneur
                7. Pelajari manajemen proyek',
                'personality_type' => 'Strategis'
            ],

            // Pertanyaan untuk kepribadian Sosial
            [
                'questions' => 'Jurusan apa yang cocok untuk kepribadian Sosial?',
                'answer' => 'Jurusan yang cocok untuk kepribadian Sosial:
                1. Psikologi
                2. Pendidikan
                3. Ilmu Komunikasi
                4. Hubungan Masyarakat
                5. Sosiologi
                6. Bimbingan Konseling
                7. Manajemen Sumber Daya Manusia
                8. Ilmu Kesejahteraan Sosial

                Tips: Pilih jurusan yang memungkinkan interaksi dengan banyak orang.',
                'personality_type' => 'Sosial'
            ],
            [
                'questions' => 'Bagaimana cara belajar efektif untuk kepribadian Sosial?',
                'answer' => 'Tips belajar efektif untuk kepribadian Sosial:
                1. Belajar kelompok dengan teman
                2. Diskusikan materi dengan dosen
                3. Bergabung dengan study group
                4. Ajarkan materi ke teman lain
                5. Ikut seminar dan workshop
                6. Aktif dalam organisasi kampus',
                'personality_type' => 'Sosial'
            ],
            [
                'questions' => 'Apa kelebihan kepribadian Sosial dalam dunia kerja?',
                'answer' => 'Kelebihan kepribadian Sosial dalam dunia kerja:
                1. Komunikasi yang efektif
                2. Kemampuan networking
                3. Teamwork yang baik
                4. Kemampuan presentasi
                5. Customer service yang baik
                6. Kemampuan negosiasi
                7. Leadership yang kuat
                8. Kemampuan membangun relasi',
                'personality_type' => 'Sosial'
            ],
            [
                'questions' => 'Bagaimana cara mengembangkan skill kepribadian Sosial?',
                'answer' => 'Cara mengembangkan skill kepribadian Sosial:
                1. Aktif dalam organisasi
                2. Ikut kegiatan sosial
                3. Latih public speaking
                4. Bergabung dengan komunitas
                5. Ikut workshop komunikasi
                6. Magang di bidang customer service
                7. Pelajari psikologi komunikasi',
                'personality_type' => 'Sosial'
            ],

            // Pertanyaan untuk kepribadian Empati
            [
                'questions' => 'Jurusan apa yang cocok untuk kepribadian Empati?',
                'answer' => 'Jurusan yang cocok untuk kepribadian Empati:
                1. Psikologi
                2. Kedokteran
                3. Keperawatan
                4. Bimbingan Konseling
                5. Ilmu Kesejahteraan Sosial
                6. Pendidikan Khusus
                7. Terapi Okupasi
                8. Kesehatan Masyarakat

                Tips: Pilih jurusan yang memungkinkan Anda membantu dan memahami orang lain.',
                'personality_type' => 'Empati'
            ],
            [
                'questions' => 'Bagaimana cara belajar efektif untuk kepribadian Empati?',
                'answer' => 'Tips belajar efektif untuk kepribadian Empati:
                1. Belajar dengan kasus nyata
                2. Praktik langsung dengan orang lain
                3. Diskusikan pengalaman personal
                4. Ikut kegiatan sosial kampus
                5. Magang di bidang yang relevan
                6. Bergabung dengan komunitas peduli',
                'personality_type' => 'Empati'
            ],
            [
                'questions' => 'Apa kelebihan kepribadian Empati dalam dunia kerja?',
                'answer' => 'Kelebihan kepribadian Empati dalam dunia kerja:
                1. Kemampuan memahami orang lain
                2. Komunikasi yang empatik
                3. Resolusi konflik yang baik
                4. Customer service yang unggul
                5. Kemampuan konseling
                6. Teamwork yang harmonis
                7. Leadership yang humanis
                8. Kemampuan mendengarkan aktif',
                'personality_type' => 'Empati'
            ],
            [
                'questions' => 'Bagaimana cara mengembangkan skill kepribadian Empati?',
                'answer' => 'Cara mengembangkan skill kepribadian Empati:
                1. Ikut kegiatan sosial
                2. Latih active listening
                3. Pelajari psikologi dasar
                4. Praktik konseling
                5. Bergabung dengan komunitas peduli
                6. Ikut workshop komunikasi empatik
                7. Magang di bidang pelayanan',
                'personality_type' => 'Empati'
            ],

            // Pertanyaan Umum
            [
                'questions' => 'Bagaimana cara mengatasi stress kuliah?',
                'answer' => 'Tips mengatasi stress kuliah:
                1. Atur jadwal belajar yang seimbang
                2. Istirahat yang cukup
                3. Olahraga teratur
                4. Makan makanan bergizi
                5. Curhat dengan teman atau keluarga
                6. Ikut kegiatan kampus yang menyenangkan
                7. Konsultasi dengan konselor kampus
                8. Jaga work-life balance',
                'personality_type' => 'Empati'
            ],
            [
                'questions' => 'Bagaimana cara memilih jurusan yang tepat?',
                'answer' => 'Tips memilih jurusan yang tepat:
                1. Kenali minat dan bakat Anda
                2. Pelajari prospek karir jurusan
                3. Konsultasi dengan konselor
                4. Ikut tes minat dan bakat
                5. Kunjungi kampus dan jurusan
                6. Diskusikan dengan orang tua
                7. Cari informasi dari alumni
                8. Pertimbangkan biaya kuliah',
                'personality_type' => 'Strategis'
            ],
            [
                'questions' => 'Bagaimana cara mengatur waktu kuliah?',
                'answer' => 'Tips mengatur waktu kuliah:
                1. Buat jadwal harian dan mingguan
                2. Prioritaskan tugas penting
                3. Gunakan aplikasi manajemen waktu
                4. Tetapkan waktu belajar tetap
                5. Jangan menunda tugas
                6. Istirahat yang cukup
                7. Evaluasi jadwal secara berkala
                8. Jaga keseimbangan akademik dan non-akademik',
                'personality_type' => 'Logis'
            ]
        ];

        foreach ($questions as $question) {
            ChatbotQuestion::create($question);
        }
    }
}
