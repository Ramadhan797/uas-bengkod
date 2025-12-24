<!-- resources/views/jadwal-periksa/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>

                       

                        <div>
                            <a href="{{ route('dokter.jadwal-periksa.create') }}"
                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Tambah Jadwal Periksa
                            </a>
                        </div>
                    </header>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Hari</th>
                                    <th class="px-4 py-2">Mulai</th>
                                    <th class="px-4 py-2">Selesai</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @foreach ($jadwalPeriksa as $jadwal)
                                    <tr>
                                        <td class="px-4 py-2">{{ $jadwal->id }}</td>
                                        <td class="px-4 py-2">{{ Str::ucfirst($jadwal->hari) }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                        <td class="px-4 py-2">
                                            @if ($jadwal->is_aktif)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 flex gap-5">
                                            <form class=""
                                                action="{{ route('dokter.jadwal-periksa.toggleStatus', $jadwal->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if ($jadwal->is_aktif)
                                                    <button type="submit"
                                                        class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 w-28">
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                        class="px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700 w-28">
                                                        Aktifkan
                                                    </button>
                                                @endif
                                               
                                            </form>
                                            <form action="{{ route('dokter.jadwal-periksa.edit', $jadwal) }}"
                                                method="GET">
                                                <button type="submit"
                                                    class="px-3 py-1 text-sm text-white bg-amber-500 rounded hover:bg-amber-700">
                                                    Edit Jadwal
                                                </button>
                                            </form>
                                            

                                        </td>
                                    </tr>
                                @endforeach
                                @if ($errors->has('hari'))
                                <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                                    {{ $errors->first('hari') }}
                                </div>
                            @endif
                            </tbody>
                        </table>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
