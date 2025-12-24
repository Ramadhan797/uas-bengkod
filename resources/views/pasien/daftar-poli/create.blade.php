<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Mendaftar Ke <span
                                class="underline">{{ $jadwalPeriksa->dokter->poli->nama_poli }}</span> </h3>
                        <p class="text-gray-600">Lengkapi informasi Daftar poli untuk menambahkan ke sistem</p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('pasien.daftar-poli.store', $jadwalPeriksa->id) }}" method="POST"
                        id="formTambahDaftarPoli" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- id_dokter -->
                            <div>
                                <label for="id_dokter" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock text-blue-500 mr-2"></i>Nama Dokter
                                </label>
                                <div class="relative">
                                    <input type="text" id="id_dokter" name="id_dokter" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 pr-12"
                                        placeholder="Sachet"
                                        value="{{ old('id_dokter', $jadwalPeriksa->dokter->name) }}" readonly>
                                </div>
                            </div>

                            <!-- keluhan -->
                            <div>
                                <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock text-blue-500 mr-2"></i>Keluhan
                                </label>
                                <div class="relative">
                                    <textarea id="keluhan" name="keluhan" rows="3" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 resize-none"
                                        placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- no_antrian -->
                        <div>
                            <label for="no_antrian" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-blue-500 mr-2"></i>No Antrean
                            </label>

                            <div class="relative">
                        
                                        <input type="text" id="no_antrian" name="no_antrian" required
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 pr-12"
                                            value="{{ old('no_antrian', $jumlahAntrian +1) }}"
                                            readonly>
                           
                            </div>


                        </div>

                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                    <strong>Ups! Ada kesalahan input:</strong>
                                    <ul class="mt-2 list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            <a type="button" href="{{ route('pasien.daftar-poli.index') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-undo mr-2"></i>Batal
                            </a>

                            @csrf
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i>Daftar Poli
                            </button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Catatan:</strong> Pastikan semua data yang dimasukkan sudah benar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
