<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Riwayat Pemeriksaan Pasien') }}
                        </h2>
                    </header>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border divide-y divide-gray-200 rounded-lg">
                            <thead class="bg-gray-100 text-sm font-medium text-gray-700 text-left">
                                <tr>
                                    <th class="px-4 py-2">No Antrean</th>
                                    <th class="px-4 py-2">Nama Pasien</th>
                                    <th class="px-4 py-2">Keluhan</th>
                                    <th class="px-4 py-2">Tanggal Periksa</th>
                                    <th class="px-4 py-2">Catatan</th>
                                    <th class="px-4 py-2">Biaya</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse ($periksas as $periksa)
                                    <tr>
                                        <td class="px-4 py-2">{{ $periksa->daftarPoli->no_antrian }}</td>
                                        <td class="px-4 py-2">{{ $periksa->daftarPoli->pasien->name }}</td>
                                        <td class="px-4 py-2">{{ $periksa->daftarPoli->keluhan }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            @if ($periksa->catatan == '-')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Belum Ada Catatan
                                                </span>
                                            @else
                                                <span class="inline-block">{{ $periksa->catatan }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ 'Rp ' . number_format($periksa->biaya_periksa, 0, ',', '.') ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            @if (!$periksa->status)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Belum Diperiksa
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 space-x-1">
                                            <a href="{{ route('dokter.periksa.show', $periksa->id) }}"
                                                class="inline-block px-3 py-1 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-3 text-center text-gray-500">
                                            Tidak ada data riwayat pemeriksaan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
