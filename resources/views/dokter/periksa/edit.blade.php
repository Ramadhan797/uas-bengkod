<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow">
                <div class="max-w-2xl mx-auto">
                    <section>
                        <header class="mb-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Form Pemeriksaan Pasien') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi catatan pemeriksaan berdasarkan keluhan pasien.') }}
                            </p>
                        </header>

                        @if (session('error'))
                            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded-md">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('dokter.periksa.update', $periksa) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                                <p class="mt-1 text-gray-900">{{ $periksa->daftarPoli->pasien->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                                <p class="mt-1 text-gray-900">{{ $periksa->daftarPoli->keluhan }}</p>
                            </div>

                            <div>
                                <label for="tanggal_periksa" class="block text-sm font-medium text-gray-700">Tanggal Periksa</label>
                                <input type="date" name="tanggal_periksa" id="tanggal_periksa"
                                    value="{{ old('tanggal_periksa', \Carbon\Carbon::parse($periksa->tanggal_periksa)->format('Y-m-d')) }}"
                                    class="mt-1 block w-full border border-gray-300 bg-gray-100 text-gray-700 rounded-md shadow-sm text-sm p-2"
                                    readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Obat</label>
                                <div class="grid gap-3">
                                    @foreach ($obats as $obat)
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" id="obat_{{ $obat->id }}" name="obat[]" value="{{ $obat->id }}"
                                                @if ($periksa->detailPeriksa->pluck('id_obat')->contains($obat->id)) checked @endif
                                                @if ($obat->stok <= 0) disabled @endif>
                                            <label for="obat_{{ $obat->id }}" class="flex-1">
                                                <span class="font-medium">{{ $obat->nama_obat }}</span>
                                                <span class="text-xs text-gray-500">{{ $obat->harga ? ' - RP ' . number_format($obat->harga, 0, ',', '.') : '' }} (stok: {{ $obat->stok ?? 0 }})</span>
                                            </label>
                                            <input type="number" name="qty[{{ $obat->id }}]" min="1" value="{{ optional($periksa->detailPeriksa->firstWhere('id_obat', $obat->id))->qty ?? 1 }}" class="w-20 px-2 py-1 border rounded">
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-500 mt-1">* Centang obat lalu isi jumlah (qty) yang diberikan.</p>
                            </div>

                            <div>
                                <label for="diagnosa" class="block text-sm font-medium text-gray-700">Diagnosa</label>
                                <textarea name="diagnosa" id="diagnosa" rows="2"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2"
                                    placeholder="Tuliskan diagnosa singkat...">{{ old('diagnosa', optional($periksa->medicalRecord)->diagnosa ?? '') }}</textarea>
                            </div>

                            <div>
                                <label for="tindakan" class="block text-sm font-medium text-gray-700">Tindakan</label>
                                <textarea name="tindakan" id="tindakan" rows="2"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2"
                                    placeholder="Tindakan atau resep yang diberikan...">{{ old('tindakan', optional($periksa->medicalRecord)->tindakan ?? '') }}</textarea>
                            </div>

                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Pemeriksaan</label>
                                <textarea name="catatan" id="catatan" rows="4"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2"
                                    placeholder="Isi catatan atau hasil diagnosa dokter...">{{ old('catatan', $periksa->catatan) }}</textarea>
                            </div>

                            <div class="flex justify-between items-center pt-4">
                                <a href="{{ route('dokter.periksa.index') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition">
                                    Simpan Catatan
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
