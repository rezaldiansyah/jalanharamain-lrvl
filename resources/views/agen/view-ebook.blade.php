<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ebook->title }} - E-book Viewer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            overflow: hidden;
        }
        .book-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: rgba(0,0,0,0.8);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .book-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .back-button {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            background: rgba(255,255,255,0.1);
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .back-button:hover {
            background: rgba(255,255,255,0.2);
        }
        .viewer-container {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #1a1a1a;
        }
        .pdf-canvas {
            max-width: 90%;
            max-height: 90%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border-radius: 8px;
        }
        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            color: #ccc;
            text-align: center;
        }
        .error-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: #dc3545;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            display: none;
        }
        .controls {
            background: rgba(0,0,0,0.9);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .nav-button {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .nav-button:hover:not(:disabled) {
            background: rgba(255,255,255,0.2);
        }
        .nav-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .page-info {
            font-size: 14px;
            color: #ccc;
        }
        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .zoom-button {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .zoom-button:hover {
            background: rgba(255,255,255,0.2);
        }
        .navigation-arrows {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.3);
            border: none;
            color: white;
            padding: 12px 10px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
            z-index: 10;
            backdrop-filter: blur(5px);
        }
        .navigation-arrows:hover:not(:disabled) {
            background: rgba(0,0,0,0.6);
            transform: translateY(-50%) scale(1.1);
        }
        .navigation-arrows:disabled {
            opacity: 0.2;
            cursor: not-allowed;
        }
        .prev-arrow {
            left: 15px;
        }
        .next-arrow {
            right: 15px;
        }
        .info-text {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="book-container">
        <div class="header">
            <div class="book-title">📖 {{ $ebook->title }}</div>
            <a href="{{ route('agen.ebook-gratis') }}" class="back-button">← Kembali ke Daftar E-book</a>
        </div>
        
        <div class="viewer-container">
            <div class="loading" id="loading">
                <div>📚 Memuat e-book...</div>
                <div style="margin-top: 10px; font-size: 14px;">Mohon tunggu sebentar</div>
            </div>
            
            <canvas id="pdfCanvas" class="pdf-canvas" style="display: none;"></canvas>
            
            <button class="navigation-arrows prev-arrow" id="prevBtn" onclick="previousPage()" disabled>
                ◀
            </button>
            
            <button class="navigation-arrows next-arrow" id="nextBtn" onclick="nextPage()" disabled>
                ▶
            </button>
            
            <div class="error-message" id="errorMessage">
                <h3>❌ Gagal memuat PDF</h3>
                <p>Maaf, terjadi kesalahan saat memuat e-book.</p>
                <a href="{{ route('agen.ebook.proxy', $ebook) }}" target="_blank" style="color: white; text-decoration: underline;">Coba buka di tab baru</a>
            </div>
        </div>
        
        <div class="controls">
            <div class="nav-controls">
                <button class="nav-button" id="firstPageBtn" onclick="goToPage(1)" disabled>
                    ⏮ Awal
                </button>
                <button class="nav-button" id="prevPageBtn" onclick="previousPage()" disabled>
                    ◀ Sebelumnya
                </button>
                <span class="page-info" id="pageInfo">Halaman - dari -</span>
                <button class="nav-button" id="nextPageBtn" onclick="nextPage()" disabled>
                    Selanjutnya ▶
                </button>
                <button class="nav-button" id="lastPageBtn" onclick="goToPage('last')" disabled>
                    Akhir ⏭
                </button>
            </div>
            
            <div class="zoom-controls">
                <button class="zoom-button" onclick="zoomOut()">🔍-</button>
                <span class="page-info" id="zoomInfo">100%</span>
                <button class="zoom-button" onclick="zoomIn()">🔍+</button>
                <button class="zoom-button" onclick="resetZoom()">Reset</button>
            </div>
            
            <div class="info-text">
                <div>💡 Gunakan panah kiri/kanan atau klik area PDF untuk navigasi</div>
                <div>🚫 Download dan print telah dinonaktifkan</div>
            </div>
        </div>
    </div>

    <script>
        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        let scale = 1.2;
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');

        // Disable right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
        
        // Disable keyboard shortcuts for save/print
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey && (e.key === 's' || e.key === 'p')) || e.key === 'F12') {
                e.preventDefault();
                return false;
            }
            
            // Navigation with arrow keys
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                previousPage();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextPage();
            } else if (e.key === 'Home') {
                e.preventDefault();
                goToPage(1);
            } else if (e.key === 'End') {
                e.preventDefault();
                goToPage('last');
            }
        });
        
        // Click navigation on canvas
        canvas.addEventListener('click', function(e) {
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const canvasWidth = rect.width;
            
            if (x < canvasWidth / 2) {
                previousPage();
            } else {
                nextPage();
            }
        });
        
        function renderPage(num) {
            pageRendering = true;
            
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                
                const renderTask = page.render(renderContext);
                
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                    updatePageInfo();
                    updateNavigationButtons();
                });
            });
        }
        
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }
        
        function previousPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        
        function nextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        
        function goToPage(page) {
            if (page === 'last') {
                page = pdfDoc.numPages;
            }
            if (page >= 1 && page <= pdfDoc.numPages) {
                pageNum = page;
                queueRenderPage(pageNum);
            }
        }
        
        function updatePageInfo() {
            document.getElementById('pageInfo').textContent = `Halaman ${pageNum} dari ${pdfDoc.numPages}`;
        }
        
        function updateNavigationButtons() {
            const prevBtns = [document.getElementById('prevBtn'), document.getElementById('prevPageBtn'), document.getElementById('firstPageBtn')];
            const nextBtns = [document.getElementById('nextBtn'), document.getElementById('nextPageBtn'), document.getElementById('lastPageBtn')];
            
            prevBtns.forEach(btn => {
                btn.disabled = pageNum <= 1;
            });
            
            nextBtns.forEach(btn => {
                btn.disabled = pageNum >= pdfDoc.numPages;
            });
        }
        
        function zoomIn() {
            scale += 0.2;
            updateZoomInfo();
            queueRenderPage(pageNum);
        }
        
        function zoomOut() {
            if (scale > 0.4) {
                scale -= 0.2;
                updateZoomInfo();
                queueRenderPage(pageNum);
            }
        }
        
        function resetZoom() {
            scale = 1.2;
            updateZoomInfo();
            queueRenderPage(pageNum);
        }
        
        function updateZoomInfo() {
            document.getElementById('zoomInfo').textContent = Math.round(scale * 100) + '%';
        }
        
        // Load PDF
        pdfjsLib.getDocument('{{ route('agen.ebook.proxy', $ebook) }}').promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('loading').style.display = 'none';
            document.getElementById('pdfCanvas').style.display = 'block';
            
            // Initial render
            renderPage(pageNum);
            updateZoomInfo();
            
        }).catch(function(error) {
            console.error('Error loading PDF:', error);
            document.getElementById('loading').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'block';
        });
    </script>
</body>
</html>