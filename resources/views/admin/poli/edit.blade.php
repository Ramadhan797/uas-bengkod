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
                        <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user-edit text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Poli</h3>
                        <p class="text-gray-600">Perbarui informasi poli sesuai kebutuhan</p>
                        <div class="mt-4 bg-amber-50 border border-amber-200 rounded-lg p-3">
                            <p class="text-amber-800 text-sm">
                                <i class="fas fa-info-circle mr-1"></i>
                                Mengedit: <strong id="currentDoctorName">{{ $poli->nama_poli }}</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST" id="formTambahpoli"
                        class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama poli -->
                            <div class="md:col-span-2">
                                <label for="poli" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user text-blue-500 mr-2"></i>Nama Poli
                                </label>
                                <input type="text" id="poli" name="nama_poli" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400"
                                    placeholder="Poli Umum" value="{{ old('nama_poli', $poli->nama_poli) }}">
                            </div>

                            <!-- keterangan -->
                            <div>
                                <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock text-blue-500 mr-2"></i>keterangan
                                </label>
                                <div class="relative">
                                    <input type="text" id="keterangan" name="keterangan" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 pr-12"
                                        placeholder="Pelayanan kesehatan umum" value="{{ old('keterangan', $poli->keterangan) }}">
                                    <button type="button"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
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
                            <a type="button" href="{{ route('admin.poli.index') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-undo mr-2"></i>Batal
                            </a>
                            <form action="{{ route('admin.poli.store', $poli->id) }}" method="POST" id="formSimpanpoli">
                                @csrf
                                <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                                    <i class="fas fa-save mr-2"></i>Simpan poli
                                </button>
                            </form>
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
                            <strong>Catatan:</strong> Pastikan semua data yang dimasukkan sudah benar. poli akan
                            menerima email dengan informasi login setelah berhasil ditambahkan ke sistem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
