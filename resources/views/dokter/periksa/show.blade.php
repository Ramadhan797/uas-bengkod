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
                                {{ __('Detail Pemeriksaan Pasien') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Detail isi catatan pemeriksaan berdasarkan keluhan pasien.') }}
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
                                <label for="obat" class="block text-sm font-medium text-gray-700 mb-1">Obat</label>
                                <select name="obat[]" id="obat" multiple
                                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2">
                                    @foreach ($detailPeriksas as $detailPeriksa)
                                        <option value="{{ $detailPeriksa->id_periksa }}"
                                            @if ($periksa->detailPeriksa->pluck('id_obat')->contains($detailPeriksa->obat->id)) selected @endif aria-readonly="true">
                                            {{ $detailPeriksa->obat->nama_obat }}
                                            {{ $detailPeriksa->obat->harga ? ' - RP ' . number_format($detailPeriksa->obat->harga, 0, ',', '.') : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan Pemeriksaan</label>
                                <textarea readonly name="catatan" id="catatan" rows="4"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm p-2"
                                    placeholder="Isi catatan atau hasil diagnosa dokter...">{{ old('catatan', $periksa->catatan) }}</textarea>
                            </div>

                            <div class="flex justify-between items-center pt-4">
                                <a href="{{ route('dokter.periksa.index') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
