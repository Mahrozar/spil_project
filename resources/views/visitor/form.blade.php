<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Desa Cicangkang Hilir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-icon {
            background: #3b82f6;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .btn-primary {
            background: #1e40af;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            width: 100%;
            font-weight: 600;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #1e3a8a;
        }
        .input-field {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem;
            width: 100%;
            transition: border-color 0.3s;
        }
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body>
    <div class="card">
        <!-- Logo & Judul -->
        <div class="logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Buku Tamu Online</h1>
            <p class="text-gray-600 mt-1">Desa Cicangkang Hilir</p>
        </div>

        <!-- Pesan -->
        <p class="text-gray-600 text-center mb-6">
            Silakan isi data diri Anda sebelum mengakses website.
        </p>

        <!-- Form -->
        <form action="{{ route('visitor.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Input Nama -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    Nama Lengkap
                </label>
                <input type="text" 
                       name="nama" 
                       required 
                       class="input-field"
                       placeholder="Masukkan nama lengkap"
                       value="{{ old('nama') }}">
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Input Alamat -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    Alamat
                </label>
                <textarea name="alamat" 
                          required 
                          rows="3"
                          class="input-field"
                          placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tombol Submit -->
            <button type="submit" class="btn-primary mt-2">
                Masuk ke Website
            </button>
            
            <!-- Catatan -->
            <p class="text-gray-500 text-xs text-center mt-4">
                Data Anda akan disimpan untuk keperluan statistik pengunjung.
            </p>
        </form>
    </div>
</body>
</html>