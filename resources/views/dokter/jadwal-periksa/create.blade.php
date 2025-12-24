<!-- resources/views/jadwal-periksa/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="mb-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Tambah Jadwal Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk menambahkan jadwal pemeriksaan dokter sesuai dengan hari dan waktu yang tersedia.') }}
                            </p>
                        </header>

                        @if (session('error'))
                            <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="mt-6 space-y-4" id="formJadwal" action="{{ route('dokter.jadwal-periksa.store') }}" method="POST">
                            @csrf

                            <div>
                                <label for="hariSelect" class="block text-sm font-medium text-gray-700">Hari</label>
                                <select name="hari" id="hariSelect" value="{{ old('hari') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Hari</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                    <option>Minggu</option>
                                </select>
                            </div>

                            <div>
                                <label for="jamMulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jamMulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('jam_mulai') }}">
                            </div>

                            <div>
                                <label for="jamSelesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jamSelesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('jam_selesai') }}">
                            </div>

                            <div class="flex items-center justify-start space-x-3">
                                <a href="{{ route('dokter.jadwal-periksa.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                    Batal
                                </a>

                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
