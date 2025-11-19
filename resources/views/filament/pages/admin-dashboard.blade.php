<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Hero / Welcome Card --}}
        <div class="rounded-2xl bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400 p-[1px] shadow">
            <div class="rounded-2xl bg-white/90 dark:bg-gray-900/90 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-2">
                    <p class="text-xs font-semibold tracking-wide text-amber-700 uppercase">
                        Dinas Kesehatan Kabupaten Tasikmalaya
                    </p>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white leading-snug">
                        Selamat datang di Aplikasi CRUD Dinas Kesehatan
                    </h1>
                    <p class="text-sm md:text-base text-gray-700 dark:text-gray-200 max-w-2xl">
                        Kelola indikator pembiayaan, jaminan kesehatan, SDM kesehatan, serta pelayanan ibu & anak
                        melalui menu di sisi kiri. Data yang rapi akan membantu pengambilan keputusan yang lebih tepat. 💊📊
                    </p>
                </div>

                <div class="flex flex-col items-start md:items-end gap-3">
                    <div class="rounded-xl bg-white/80 dark:bg-gray-950/70 px-4 py-3 shadow-sm">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Login sebagai
                        </p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ auth()->user()->name ?? 'Admin' }}
                        </p>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs md:text-right">
                        Tip: gunakan fitur pencarian di setiap tabel untuk mempercepat pencarian fasilitas atau kecamatan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Ringkasan area utama --}}
        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg">
                        🩺
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                            KIA & Imunisasi
                        </p>
                        <p class="text-sm text-gray-800 dark:text-gray-100">
                            Cakupan imunisasi Td dan TTD ibu hamil per kecamatan & puskesmas.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg">
                        📑
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                            Pembiayaan & Jamkes
                        </p>
                        <p class="text-sm text-gray-800 dark:text-gray-100">
                            Pantau cakupan jaminan kesehatan penduduk berdasarkan jenis kepesertaan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-lg">
                        👥
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                            SDM Kesehatan
                        </p>
                        <p class="text-sm text-gray-800 dark:text-gray-100">
                            Lihat distribusi tenaga medis, perawat, bidan, farmasi, dan tenaga lainnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>
