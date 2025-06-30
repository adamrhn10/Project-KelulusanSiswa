<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LulusApp - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Memuat Font Awesome untuk ikon topi toga --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('template/assets/img/favicon.ico')}}" />

    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom font untuk logo SVG */
        .svg-logo-text {
            font-family: 'Poppins', sans-serif; /* Menggunakan Poppins untuk teks SVG agar lebih modern */
            font-weight: 700; /* Bold */
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>
<body class="font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Column (40%) - Sesuai dengan halaman login -->
        <div class="w-full md:w-2/5 bg-[#171C33] p-6 md:p-8 relative overflow-hidden flex flex-col"> 
            <!-- SVG Logo with Toga Icon -->
            <div class="flex items-center space-x-3 mb-auto"> 
                <i class="fas fa-graduation-cap text-white text-4xl"></i>
                <div class="w-40 h-10">
                    <svg viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                        <text x="0" y="35" class="svg-logo-text" font-size="30" fill="white">LulusApp</text>
                    </svg>
                </div>
            </div>
            
            <!-- Deskripsi Aplikasi - Sesuai dengan halaman login -->
            <div class="text-white max-w-sm flex-grow pt-24 md:pt-32 lg:pt-40"> 
                <h2 class="text-2xl md:text-3xl font-bold mb-3">Sistem Prediksi Kelulusan Siswa</h2>
                <p class="text-sm md:text-base opacity-90 leading-relaxed">
                    LulusApp adalah platform inovatif untuk memprediksi status kelulusan siswa. Dengan metode Fuzzy Mamdani, sistem ini menganalisis nilai kriteria secara objektif, membantu Anda membuat keputusan yang akurat dan tepat dalam evaluasi pendidikan.
                </p>
            </div>

            <!-- Spacer div kosong -->
            <div></div>

            <!-- Decorative Circles -->
            <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-[#1E233D] opacity-20"></div>
            <div class="absolute bottom-1/4 -left-20 w-40 h-40 rounded-full bg-[#2A3050] opacity-20"></div>
            <div class="absolute top-1/3 left-1/4 w-24 h-24 rounded-full bg-[#3A4166] opacity-20"></div>
        </div>
        
        <!-- Right Column (60%) - Form Registrasi -->
        <div class="w-full md:w-3/5 bg-white p-6 md:p-12 lg:p-20 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <!-- Register Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Register</h1>
                
                <!-- Registration Form -->
                {{-- Anda bisa mengganti '#' dengan rute POST untuk registrasi Anda (misal: route('register')) --}}
                <form class="space-y-6" action="#" method="POST"> 
                    @csrf {{-- Penting untuk Laravel security --}}

                    <!-- Name Input -->
                    <div>
                        <input 
                            type="text" 
                            name="name" {{-- Tambahkan atribut name --}}
                            placeholder="Nama Lengkap" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                            value="{{ old('name') }}" {{-- Pertahankan input lama --}}
                        >
                        @error('name') {{-- Tampilkan error validasi --}}
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <input 
                            type="email" 
                            name="email" {{-- Tambahkan atribut name --}}
                            placeholder="Email" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password Input -->
                    <div>
                        <input 
                            type="password" 
                            name="password" {{-- Tambahkan atribut name --}}
                            placeholder="Password" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                        >
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <input 
                            type="password" 
                            name="password_confirmation" {{-- Tambahkan atribut name --}}
                            placeholder="Konfirmasi Password" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A1F36] focus:border-transparent"
                            required
                        >
                    </div>
                    
                    <!-- Links Row (ubah untuk registrasi) -->
                    
                    
                    <!-- Register Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-[#1A1F36] hover:bg-[#232844] text-white font-medium py-3 px-4 rounded-full uppercase focus:outline-none focus:ring-2 focus:ring-[#7B61FF] focus:ring-opacity-50 transition duration-200"
                    >
                        Register
                    </button>
                    <div class="text-center mt-4"> {{-- Hanya flex-end untuk link login --}}
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">Sudah punya akun? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
