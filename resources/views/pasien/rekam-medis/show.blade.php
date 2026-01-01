<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Rekam Medis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium mb-4">Detail Rekam Medis</h3>

                <div class="space-y-4">
                    <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($record->tanggal)->format('Y-m-d') }}</div>
                    <div><strong>Dokter:</strong> {{ $record->dokter->name }}</div>
                    <div><strong>Diagnosa:</strong><div class="mt-1 p-3 bg-gray-50">{{ $record->diagnosa }}</div></div>
                    <div><strong>Tindakan:</strong><div class="mt-1 p-3 bg-gray-50">{{ $record->tindakan }}</div></div>
                    <div><strong>Catatan:</strong><div class="mt-1 p-3 bg-gray-50">{{ $record->catatan }}</div></div>
                    <div><strong>Biaya:</strong> Rp {{ number_format($record->biaya,0,',','.') }}</div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('pasien.rekam-medis.index') }}" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>