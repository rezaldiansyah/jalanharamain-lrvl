<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload E-Book Baru - Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .btn:hover {
            background: #45a049;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .price-field {
            display: none;
        }

        .file-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>📚 Upload E-Book Baru</h1>
            <p style="margin-bottom: 30px; color: #666;">Upload file PDF e-book ke Bunny.net Cloud Storage</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ebooks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Judul E-Book *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" placeholder="Deskripsi singkat tentang e-book ini...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category">Kategori *</label>
                    <select id="category" name="category" required onchange="togglePriceField()">
                        <option value="gratis" {{ old('category') === 'gratis' ? 'selected' : '' }}>Gratis</option>
                        <option value="berbayar" {{ old('category') === 'berbayar' ? 'selected' : '' }}>Berbayar</option>
                    </select>
                </div>

                <div class="form-group price-field" id="priceField">
                    <label for="price">Harga (Rp) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="0.01">
                </div>

                <div class="form-group">
                    <label for="file">File PDF *</label>
                    <input type="file" id="file" name="file" accept=".pdf" required>
                    <div class="file-info">
                        * Hanya file PDF yang diizinkan, maksimal 10MB
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn">📤 Upload E-Book</button>
                    <a href="{{ route('admin.ebooks') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePriceField() {
            const category = document.getElementById('category').value;
            const priceField = document.getElementById('priceField');
            const priceInput = document.getElementById('price');
            
            if (category === 'berbayar') {
                priceField.style.display = 'block';
                priceInput.required = true;
            } else {
                priceField.style.display = 'none';
                priceInput.required = false;
                priceInput.value = '';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            togglePriceField();
        });
    </script>
</body>
</html>