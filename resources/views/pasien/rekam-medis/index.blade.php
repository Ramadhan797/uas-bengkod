<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Rekam Medis Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Daftar Rekam Medis</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                            <tr>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Dokter</th>
                                <th class="px-4 py-2">Diagnosa</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($records as $rec)
                                <tr>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($rec->tanggal)->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2">{{ $rec->dokter->name }}</td>
                                    <td class="px-4 py-2">{{ Str::limit($rec->diagnosa, 60) }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('pasien.rekam-medis.show', $rec->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-gray-500">Belum ada rekam medis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>