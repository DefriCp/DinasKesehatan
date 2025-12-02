<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AngkaKematianRsDashboardController;
use App\Http\Controllers\Api\TenagaMedisDashboardController;
use App\Http\Controllers\Api\TenagaKeperawatandanTenagaKebidananDashboardController;
use App\Http\Controllers\Api\TenagaKesmasKeslingdanGiziDashboardController;
use App\Http\Controllers\Api\TenagaTeknikBiomedikaKeterapianKeteknisianDashboardController;
use App\Http\Controllers\Api\TenagaFarmasiDashboardController;
use App\Http\Controllers\Api\JamKesPendudukDashboardController;
use App\Http\Controllers\Api\PelayananKesehatanIbuDashboardController;
use App\Http\Controllers\Api\ImunisasiTdIbuHamilDashboardController;
use App\Http\Controllers\Api\TtdIbuHamilDashboardController;
use App\Http\Controllers\Api\PelayananKesehatanUsiaProduktifDashboardController;
use App\Http\Controllers\Api\CakupanPelayananKesehatanUsiaLanjutDashboardController;
use App\Http\Controllers\Api\DataTuberkulosisDashboardController;
use App\Http\Controllers\Api\PneumoniaBalitaDashboardController;
use App\Http\Controllers\Api\KasusHivKelompokUmurDashboardController;
use App\Http\Controllers\Api\KasusDiareDashboardController;
use App\Http\Controllers\Api\DeteksiHepatitisBumilDashboardController;
use App\Http\Controllers\Api\KasusBaruKustaDashboardController;
use App\Http\Controllers\Api\KejadianLuarBiasaDashboardController;
use App\Http\Controllers\Api\KasusDbdDashboardController;
use App\Http\Controllers\Api\KasusMalariaDashboardController;
use App\Http\Controllers\Api\PenderitaKronisFilariasisDashboardController;
use App\Http\Controllers\Api\PelayananKesehatanHipertensiDashboardController;
use App\Http\Controllers\Api\PelayananKesehatanDMDashboardController;
use App\Http\Controllers\Api\PelayananKesehatanOdgjBeratDashboardController;
use App\Http\Controllers\Api\KasusFluBurungDashboardController;

// Route default bawaan Sanctum, biarkan saja kalau masih dipakai
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Semua API dashboard indikator (1–26) dilindungi oleh API Key
Route::middleware('dinkes.api')->prefix('v1')->group(function () {
    // 1. Angka Kematian RS
    Route::get('angka-kematian-rs/dashboard', AngkaKematianRsDashboardController::class);

    // 2. Tenaga Medis
    Route::get('tenaga-medis/dashboard', TenagaMedisDashboardController::class);

    // 3. Tenaga Keperawatan & Kebidanan
    Route::get(
        'tenaga-keperawatan-kebidanan/dashboard',
        TenagaKeperawatandanTenagaKebidananDashboardController::class
    );

    // 4. Tenaga Kesmas, Kesling, dan Gizi
    Route::get(
        'tenaga-kesmas-kesling-gizi/dashboard',
        TenagaKesmasKeslingdanGiziDashboardController::class
    );

    // 5. Tenaga Teknik Biomedika, Keterapian, Keteknisian
    Route::get(
        'tenaga-teknik-biomedika-keterapian-keteknisian/dashboard',
        TenagaTeknikBiomedikaKeterapianKeteknisianDashboardController::class
    );

    // 6. Tenaga Farmasi
    Route::get(
        'tenaga-farmasi/dashboard',
        TenagaFarmasiDashboardController::class
    );

    // 7. Jaminan Kesehatan Penduduk
    Route::get(
        'jam-kes-penduduk/dashboard',
        JamKesPendudukDashboardController::class
    );

    // 8. Pelayanan Kesehatan Ibu
    Route::get(
        'pelayanan-kesehatan-ibu/dashboard',
        PelayananKesehatanIbuDashboardController::class
    );

    // 9. Imunisasi TD Ibu Hamil
    Route::get(
        'imunisasi-td-ibu-hamil/dashboard',
        ImunisasiTdIbuHamilDashboardController::class
    );

    // 10. TTD Ibu Hamil
    Route::get(
        'ttd-ibu-hamil/dashboard',
        TtdIbuHamilDashboardController::class
    );

    // 11. Pelayanan Kesehatan Usia Produktif
    Route::get(
        'pelayanan-kesehatan-usia-produktif/dashboard',
        PelayananKesehatanUsiaProduktifDashboardController::class
    );

    // 12. Cakupan Pelayanan Kesehatan Usia Lanjut
    Route::get(
        'cakupan-pelayanan-kesehatan-usia-lanjut/dashboard',
        CakupanPelayananKesehatanUsiaLanjutDashboardController::class
    );

    // 13. Data Tuberkulosis
    Route::get(
        'data-tuberkulosis/dashboard',
        DataTuberkulosisDashboardController::class
    );

    // 14. Pneumonia Balita
    Route::get(
        'pneumonia-balita/dashboard',
        PneumoniaBalitaDashboardController::class
    );

    // 15. Kasus HIV Kelompok Umur
    Route::get(
        'kasus-hiv-kelompok-umur/dashboard',
        KasusHivKelompokUmurDashboardController::class
    );

    // 16. Kasus Diare
    Route::get(
        'kasus-diare/dashboard',
        KasusDiareDashboardController::class
    );

    // 17. Deteksi Hepatitis Bumil
    Route::get(
        'deteksi-hepatitis-bumil/dashboard',
        DeteksiHepatitisBumilDashboardController::class
    );

    // 18. Kasus Baru Kusta
    Route::get(
        'kasus-baru-kusta/dashboard',
        KasusBaruKustaDashboardController::class
    );

    // 19. Kejadian Luar Biasa
    Route::get(
        'kejadian-luar-biasa/dashboard',
        KejadianLuarBiasaDashboardController::class
    );

    // 20. Kasus DBD
    Route::get(
        'kasus-dbd/dashboard',
        KasusDbdDashboardController::class
    );

    // 21. Kasus Malaria
    Route::get(
        'kasus-malaria/dashboard',
        KasusMalariaDashboardController::class
    );

    // 22. Penderita Kronis Filariasis
    Route::get(
        'penderita-kronis-filariasis/dashboard',
        PenderitaKronisFilariasisDashboardController::class
    );

    // 23. Pelayanan Kesehatan Hipertensi
    Route::get(
        'pelayanan-kesehatan-hipertensi/dashboard',
        PelayananKesehatanHipertensiDashboardController::class
    );

    // 24. Pelayanan Kesehatan DM
    Route::get(
        'pelayanan-kesehatan-dm/dashboard',
        PelayananKesehatanDMDashboardController::class
    );

    // 25. Pelayanan Kesehatan ODGJ Berat
    Route::get(
        'pelayanan-kesehatan-odgj-berat/dashboard',
        PelayananKesehatanOdgjBeratDashboardController::class
    );

    // 26. Kasus Flu Burung
    Route::get(
        'kasus-flu-burung/dashboard',
        KasusFluBurungDashboardController::class
    );
});
