<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
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
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Data Pasien</h3>
                        <p class="text-gray-600">Perbarui informasi pasien sesuai kebutuhan</p>
                        <div class="mt-4 bg-amber-50 border border-amber-200 rounded-lg p-3">
                            <p class="text-amber-800 text-sm">
                                <i class="fas fa-info-circle mr-1"></i>
                                Mengedit: <strong id="currentDoctorName">{{ $pasien->name }}</strong>
                            </p>
                        </div>

                        @if ($errors->any())
                        <div class="mt-4">
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
                    </div>

                    <!-- Form -->
                    <form id="formEditPasien" method="POST" action="{{ route('admin.pasien.update', $pasien->id) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Nama pasien -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-amber-500 mr-2"></i>Nama Lengkap pasien
                            </label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-amber-100 focus:border-amber-500 transition-all duration-300"
                                placeholder="Dr. Nama Lengkap"
                                value="{{ old('name', $pasien->name) }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-amber-500 mr-2"></i>Email
                            </label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300"
                                placeholder="pasien@email.com"
                                value="{{ old('email', $pasien->email) }}">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-amber-500 mr-2"></i>Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300 pr-12"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kosongkan jika tidak ingin mengubah password
                            </p>
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-amber-500 mr-2"></i>Alamat Lengkap
                            </label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300 resize-none"
                                placeholder="Jl. Nama Jalan No. XX">{{ old('alamat', $pasien->alamat) }}</textarea>
                        </div>

                        <!-- No KTP -->
                        <div>
                            <label for="no_ktp" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-id-card text-amber-500 mr-2"></i>Nomor KTP
                            </label>
                            <input type="text" id="no_ktp" name="no_ktp" required maxlength="16"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300"
                                value="{{ old('no_ktp', $pasien->no_ktp) }}">
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-amber-500 mr-2"></i>Nomor HP
                            </label>
                            <input type="tel" id="no_hp" name="no_hp" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300"
                                value="{{ old('no_hp', $pasien->no_hp) }}">
                        </div>
                        <!-- No RM -->
                        <div>
                            <label for="no_rm" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-amber-500 mr-2"></i>Nomor RM
                            </label>
                            <input type="tel" id="no_rm" name="no_rm" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-amber-100 focus:border-amber-500 transition-all duration-300"
                                value="{{ old('no_rm', $pasien->no_rm) }}" readonly>
                        </div>

                      

                        <!-- Action Buttons -->
                        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST" class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        @csrf
                        @method('PATCH')
                            <button type="submit"
                                class="flex-1 w-full bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold py-3 px-6 rounded-xl">
                                <i class="fas fa-save mr-2"></i>Update Data
                            </button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
