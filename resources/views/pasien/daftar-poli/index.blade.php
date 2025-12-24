<!-- resources/views/jadwal-periksa/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mendaftar Poli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @forelse ($polis as $poli)
                    <section>
                        <header class="flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900 mt-4">
                                <strong class="underline">{{ $poli->nama_poli }}</strong> - {{ $poli->keterangan }}


                            </h2>

                        </header>

                        <div class="overflow-x-auto mt-6">
                            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                                <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                    <tr>
                                        <th class="px-4 py-2">ID Jadwal</th>
                                        <th class="px-4 py-2">Dokter</th>
                                        <th class="px-4 py-2">Hari</th>
                                        <th class="px-4 py-2">Mulai</th>
                                        <th class="px-4 py-2">Selesai</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    @foreach ($poli->dokter as $dokter)
                                        @foreach ($dokter->jadwalPeriksa as $jadwal)
                                            @if ($jadwal->is_aktif == true)
                                                <tr>
                                                    <td class="px-4 py-2">{{ $poli->id }}</td>
                                                    <td class="px-4 py-2">{{ $dokter->name }}</td>
                                                    <td class="px-4 py-2">{{ Str::ucfirst($jadwal->hari) }}</td>
                                                    <td class="px-4 py-2">
                                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                                    </td>
                                                    <td class="px-4 py-2 flex gap-5">
                                                        <form
                                                            action="{{ route('pasien.daftar-poli.create', $jadwal->id) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="px-3 py-1 text-sm text-white bg-amber-500 rounded hover:bg-amber-700">
                                                                Daftar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach


                                    @if ($errors->has('hari'))
                                        <div
                                            class="p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                                            {{ $errors->first('hari') }}
                                        </div>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </section>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
