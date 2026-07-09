<!-- ============================================ -->
<!-- FILE: whatsapp.php                           -->
<!-- FLOATING WHATSAPP BUTTON - LIVE CHAT STYLE   -->
<!-- ============================================ -->

<section id="whatsapp-section" class="whatsapp-section">
    <!-- KONTEN UTAMA (opsional, untuk demo) -->
    <div class="wa-content">
        <h2>💬 Butuh Bantuan?</h2>
        <p>Klik tombol WhatsApp di pojok kanan bawah untuk terhubung dengan tim kami secara langsung.</p>
        <div class="wa-badge">
            <span class="wa-online-dot"></span> Online 24/7
        </div>
    </div>

    <!-- FLOATING WHATSAPP BUTTON -->
    <div class="whatsapp-float" id="whatsappFloat">
        <!-- Tooltip (muncul saat hover) -->
        <div class="whatsapp-tooltip" id="tooltip">
            <i class="fas fa-comment-dots" style="color: #25D366; margin-right: 6px;"></i> 
            Hubungi kami via WhatsApp
        </div>

        <!-- Tombol WhatsApp -->
        <a href="https://wa.me/6281234567890?text=Halo%20saya%20butuh%20bantuan" 
           class="whatsapp-btn" 
           id="whatsappBtn"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Chat WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</section>

<!-- ============================================ -->
<!-- CSS & JS (inline dalam file)                 -->
<!-- ============================================ -->
<style>
    /* ===== RESET & BASE ===== */
    .whatsapp-section {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f0f4f8 0%, #e6edf5 100%);
        min-height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* ===== KONTEN DEMO ===== */
    .wa-content {
        max-width: 600px;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .wa-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1a2b3c;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .wa-content p {
        color: #4a5b6c;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .wa-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e8f5e9;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e7e34;
        border: 1px solid #c8e6c9;
    }

    .wa-online-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        background: #25D366;
        border-radius: 50%;
        animation: onlinePulse 1.8s infinite;
    }

    @keyframes onlinePulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
        100% { opacity: 1; transform: scale(1); }
    }

    /* ===== FLOATING WHATSAPP BUTTON ===== */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;

        /* Animasi masuk (diatur JS) */
        opacity: 0;
        transform: translateY(20px) scale(0.9);
        animation: floatIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        animation-delay: 0.3s;
    }

    /* Tooltip / bubble teks */
    .whatsapp-tooltip {
        background: #ffffff;
        padding: 10px 18px;
        border-radius: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        font-size: 0.9rem;
        font-weight: 500;
        color: #1a2b3c;
        opacity: 0;
        transform: translateY(10px) scale(0.95);
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none;
        white-space: nowrap;
        border: 1px solid #e9edf2;
        position: relative;
        margin-bottom: 4px;
    }

    /* Segitiga kecil di tooltip */
    .whatsapp-tooltip::after {
        content: '';
        position: absolute;
        bottom: -8px;
        right: 20px;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #ffffff;
        filter: drop-shadow(0 2px 2px rgba(0,0,0,0.03));
    }

    /* Tombol utama */
    .whatsapp-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background: #25D366;
        border-radius: 50%;
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
        text-decoration: none;
        color: white;
        font-size: 38px;
        transition: all 0.25s ease;
        position: relative;
        animation: pulse-ring 2.5s infinite;
    }

    /* Efek gelombang di belakang tombol (ring) */
    .whatsapp-btn::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(37, 211, 102, 0.25);
        animation: pulse-ring 2.5s infinite;
        z-index: -1;
    }

    /* Hover efek */
    .whatsapp-btn:hover {
        transform: scale(1.08);
        background: #20b85f;
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.5);
    }

    .whatsapp-btn:hover i {
        transform: rotate(-6deg) scale(1.05);
    }

    /* Tooltip muncul saat hover container */
    .whatsapp-float:hover .whatsapp-tooltip {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* ===== ANIMASI ===== */
    @keyframes pulse-ring {
        0% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.25); opacity: 0.1; }
        100% { transform: scale(1); opacity: 0.6; }
    }

    @keyframes floatIn {
        0% { opacity: 0; transform: translateY(20px) scale(0.9); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .whatsapp-btn i {
        transition: transform 0.2s ease;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 480px) {
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
        }
        .whatsapp-btn {
            width: 60px;
            height: 60px;
            font-size: 32px;
        }
        .whatsapp-tooltip {
            font-size: 0.8rem;
            padding: 6px 14px;
        }
        .wa-content h2 {
            font-size: 1.5rem;
        }
        .wa-content p {
            font-size: 0.95rem;
        }
    }

    /* ===== TAMBAHAN UNTUK SECTION ===== */
    .whatsapp-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(37, 211, 102, 0.04) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .whatsapp-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(37, 211, 102, 0.03) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
</style>

<!-- ============================================ -->
<!-- JAVASCRIPT                                   -->
<!-- ============================================ -->
<script>
    (function() {
        'use strict';

        // Ambil elemen
        const floatContainer = document.getElementById('whatsappFloat');
        const tooltip = document.getElementById('tooltip');
        const btn = document.getElementById('whatsappBtn');

        // Cegah error jika elemen tidak ditemukan
        if (!floatContainer || !tooltip || !btn) return;

        // 1. Animasi "nudge" kecil setelah load
        setTimeout(() => {
            floatContainer.style.transition = 'transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1)';
            floatContainer.style.transform = 'scale(1.04)';
            setTimeout(() => {
                floatContainer.style.transform = 'scale(1)';
                setTimeout(() => {
                    floatContainer.style.transition = '';
                }, 200);
            }, 200);
        }, 900);

        // 2. Tooltip dengan efek hover (sinkron)
        let tooltipTimeout;

        const showTooltip = () => {
            tooltip.style.opacity = '1';
            tooltip.style.transform = 'translateY(0) scale(1)';
            tooltip.style.transition = 'opacity 0.25s ease, transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1)';
        };

        const hideTooltip = () => {
            tooltip.style.opacity = '0';
            tooltip.style.transform = 'translateY(10px) scale(0.95)';
            tooltip.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
        };

        floatContainer.addEventListener('mouseenter', () => {
            clearTimeout(tooltipTimeout);
            showTooltip();
        });

        floatContainer.addEventListener('mouseleave', () => {
            tooltipTimeout = setTimeout(() => {
                hideTooltip();
            }, 150);
        });

        // 3. Efek klik pada tombol
        btn.addEventListener('click', function(e) {
            this.style.transition = 'transform 0.1s ease';
            this.style.transform = 'scale(0.92)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
                setTimeout(() => {
                    this.style.transition = '';
                }, 200);
            }, 150);
        });

        // 4. Animasi perhatian: tooltip berkedip setiap 8 detik (jika tidak di-hover)
        let attentionInterval = setInterval(() => {
            if (!floatContainer.matches(':hover')) {
                tooltip.style.transition = 'opacity 0.15s ease, transform 0.15s ease';
                tooltip.style.opacity = '0.5';
                tooltip.style.transform = 'translateY(2px) scale(0.98)';
                setTimeout(() => {
                    tooltip.style.opacity = '1';
                    tooltip.style.transform = 'translateY(0) scale(1)';
                    setTimeout(() => {
                        tooltip.style.transition = '';
                    }, 200);
                }, 200);
            }
        }, 8000);

        // Bersihkan interval saat halaman ditutup
        window.addEventListener('beforeunload', function() {
            clearInterval(attentionInterval);
        });

        console.log('🚀 WhatsApp Button (whatsapp.php) siap!');
    })();
</script>