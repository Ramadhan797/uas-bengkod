<!-- resources/views/-periksa/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __(' Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar  Periksa') }}
                        </h2>
                    </header>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">No Antrean</th>
                                    <th class="px-4 py-2">Nama Pasien</th>
                                    <th class="px-4 py-2">Keluhan
                                    </th>
                                    <th class="px-4 py-2">Tanggal Periksa</th>
                                    <th class="px-4 py-2">Catatan</th>
                                    <th class="px-4 py-2">Biaya</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse ($daftarPolis as $daftarPoli)
                                    @foreach ($daftarPoli->periksa as $periksa)
                                        <tr>
                                            <td class="px-4 py-2">{{ $daftarPoli->no_antrian }}</td>
                                            <td class="px-4 py-2">{{ $daftarPoli->pasien->name }}</td>
                                            <td class="px-4 py-2">{{ $daftarPoli->keluhan }}</td>
                                            <td class="px-4 py-2">
                                                {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-4 py-2">
                                                @if ($periksa->catatan == null)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Pasien Belum Diperiksa
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5">{{ $periksa->catatan }}</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ 'Rp ' . number_format($periksa->biaya_periksa, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-2">
                                                @if (!$periksa->status)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Belum Diperiksa
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Selesai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                <a href="{{ route('dokter.periksa.edit', $periksa->id) }}"
                                                    class="inline-block px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                                                    Periksa
                                                </a>
                                                <a href="{{ route('dokter.periksa.show', $periksa->id) }}"
                                                    class="inline-block px-3 py-1 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                      
                                     
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center px-4 py-3 text-gray-500">Tidak ada pasien yang diperiksa.</td>
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
