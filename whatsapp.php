<!-- ============================================ -->
<!-- FILE: whatsapp.php                           -->
<!-- FLOATING WHATSAPP WITH CHAT POPUP PREVIEW   -->
<!-- ============================================ -->

<!-- FLOATING WHATSAPP BUTTON -->
<div class="whatsapp-float" id="whatsappFloat">
    
    <!-- CHAT POPUP (muncul saat diklik) -->
    <div class="whatsapp-popup" id="whatsappPopup">
        <!-- Header Popup -->
        <div class="popup-header">
            <div class="popup-avatar">
                <img src="images/logonew.jpeg" alt="CS">
            </div>
            <div class="popup-info">
                <h4>GET Support</h4>
                <span class="popup-status">
                    <span class="status-dot"></span> Online
                </span>
            </div>
            <button class="popup-close" id="popupClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body Popup (Preview Chat) -->
        <div class="popup-body">
            <div class="chat-message">
                <div class="message-avatar">
                    <img src="images/logonew.jpeg" alt="CS">
                </div>
                <div class="message-bubble">
                    <p>Hallo ! 😊</p>
                    <p>Selamat datang di PT Ganda Elang Tangguh - Dealer Resmi LiuGong Indonesia.</p>
                    <p>Ada yang bisa kami bantu? Tim GET siap melayani! 😊</p>
                    <span class="message-time">08:00</span>
                </div>
            </div>
            <div class="chat-status">
                <span>Typically replies within a day</span>
            </div>
        </div>

        <!-- Footer Popup (Tombol Chat) -->
        <div class="popup-footer">
            <a href="https://wa.me/6281234567890?text=Halo%20saya%20butuh%20bantuan" 
               class="btn-chat-wa" 
               target="_blank"
               rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i> Chat on WhatsApp
            </a>
        </div>
    </div>

    <!-- TOMBOL FLOATING (Chat With Us) -->
    <button class="whatsapp-btn" id="whatsappBtn">
        <i class="fab fa-whatsapp"></i>
        <span class="btn-label">Chat With Us</span>
    </button>

</div>

<!-- ============================================ -->
<!-- CSS                                           -->
<!-- ============================================ -->
<style>
    /* ===== FLOATING CONTAINER ===== */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
        
        /* Animasi masuk */
        opacity: 0;
        transform: translateY(20px) scale(0.9);
        animation: floatIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        animation-delay: 0.3s;
    }

    /* ===== TOMBOL FLOATING ===== */
    .whatsapp-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 22px;
        background: #25D366;
        border: none;
        border-radius: 50px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .whatsapp-btn i {
        font-size: 26px;
        transition: transform 0.3s ease;
    }

    .whatsapp-btn .btn-label {
        font-size: 15px;
        letter-spacing: 0.3px;
    }

    /* Efek pulse di belakang tombol */
    .whatsapp-btn::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50px;
        background: rgba(37, 211, 102, 0.25);
        animation: pulse-ring 2.5s infinite;
        z-index: -1;
    }

    .whatsapp-btn:hover {
        transform: scale(1.05);
        background: #20b85f;
        box-shadow: 0 8px 30px rgba(37, 211, 102, 0.5);
    }

    .whatsapp-btn:hover i {
        transform: rotate(-8deg) scale(1.1);
    }

    /* ===== POPUP CHAT ===== */
    .whatsapp-popup {
        width: 340px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 12px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        opacity: 0;
        transform: translateY(20px) scale(0.9);
        pointer-events: none;
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        margin-bottom: 8px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .whatsapp-popup.active {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* Header Popup */
    .popup-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        background: #075E54;
        color: white;
        position: relative;
    }

    .popup-avatar img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .popup-info {
        flex: 1;
    }

    .popup-info h4 {
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        color: white;
    }

    .popup-status {
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
        color: #B0D4D1;
    }

    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #25D366;
        border-radius: 50%;
        animation: onlinePulse 1.8s infinite;
    }

    .popup-close {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: background 0.2s;
    }

    .popup-close:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    /* Body Popup */
    .popup-body {
        padding: 16px 18px;
        background: #ECE5DD;
        min-height: 120px;
    }

    .chat-message {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .message-avatar img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .message-bubble {
        background: white;
        padding: 10px 14px;
        border-radius: 8px 8px 8px 0;
        max-width: 80%;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
    }

    .message-bubble p {
        margin: 0;
        font-size: 14px;
        color: #1a2b3c;
        line-height: 1.5;
    }

    .message-bubble p:first-child {
        margin-bottom: 2px;
    }

    .message-time {
        font-size: 10px;
        color: #8a9aa8;
        display: block;
        text-align: right;
        margin-top: 4px;
    }

    .chat-status {
        text-align: center;
        font-size: 11px;
        color: #6b7a8a;
        background: rgba(255, 255, 255, 0.7);
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-block;
        margin: 0 auto;
        width: 100%;
        text-align: center;
    }

    /* Footer Popup */
    .popup-footer {
        padding: 12px 18px 16px;
        background: white;
        border-top: 1px solid #f0f0f0;
    }

    .btn-chat-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 12px;
        background: #25D366;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn-chat-wa:hover {
        background: #20b85f;
        transform: scale(1.02);
        color: white;
    }

    .btn-chat-wa i {
        font-size: 22px;
    }

    /* ===== ANIMASI ===== */
    @keyframes pulse-ring {
        0% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.3); opacity: 0.1; }
        100% { transform: scale(1); opacity: 0.6; }
    }

    @keyframes onlinePulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
        100% { opacity: 1; transform: scale(1); }
    }

    @keyframes floatIn {
        0% { opacity: 0; transform: translateY(20px) scale(0.9); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 480px) {
        .whatsapp-float {
            bottom: 20px;
            right: 16px;
        }

        .whatsapp-popup {
            width: 300px;
            right: 0;
        }

        .whatsapp-btn {
            padding: 10px 18px;
            font-size: 14px;
        }

        .whatsapp-btn i {
            font-size: 22px;
        }

        .whatsapp-btn .btn-label {
            font-size: 13px;
        }

        .popup-header {
            padding: 12px 14px;
        }

        .popup-body {
            padding: 12px 14px;
        }

        .message-bubble p {
            font-size: 13px;
        }
    }
</style>

<!-- ============================================ -->
<!-- JAVASCRIPT                                   -->
<!-- ============================================ -->
<script>
    (function() {
        'use strict';

        const floatContainer = document.getElementById('whatsappFloat');
        const popup = document.getElementById('whatsappPopup');
        const btn = document.getElementById('whatsappBtn');
        const closeBtn = document.getElementById('popupClose');

        // Cegah error
        if (!floatContainer || !popup || !btn || !closeBtn) return;

        // State
        let isPopupOpen = false;

        // ===== BUKA POPUP =====
        function openPopup() {
            popup.classList.add('active');
            isPopupOpen = true;
            
            // Animasi getar kecil pada tombol
            btn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 150);
        }

        // ===== TUTUP POPUP =====
        function closePopup() {
            popup.classList.remove('active');
            isPopupOpen = false;
        }

        // ===== TOGGLE POPUP =====
        function togglePopup(e) {
            e.stopPropagation();
            if (isPopupOpen) {
                closePopup();
            } else {
                openPopup();
            }
        }

        // ===== EVENT LISTENERS =====
        // Klik tombol WhatsApp
        btn.addEventListener('click', togglePopup);

        // Klik tombol close
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closePopup();
        });

        // Klik di luar popup (tutup)
        document.addEventListener('click', function(e) {
            if (isPopupOpen && !floatContainer.contains(e.target)) {
                closePopup();
            }
        });

        // ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isPopupOpen) {
                closePopup();
            }
        });

        // ===== TAMPILKAN POPUP OTOMATIS SETELAH 5 DETIK (sekali saja) =====
        let hasAutoOpened = false;
        setTimeout(() => {
            if (!hasAutoOpened && !isPopupOpen) {
                openPopup();
                hasAutoOpened = true;
                // Tutup otomatis setelah 6 detik
                setTimeout(() => {
                    if (isPopupOpen) {
                        closePopup();
                    }
                }, 6000);
            }
        }, 3000);

        // ===== EFFECT KETIKA HOVER (tooltip sederhana) =====
        let hoverTimeout;
        floatContainer.addEventListener('mouseenter', () => {
            clearTimeout(hoverTimeout);
            if (!isPopupOpen) {
                // Efek naik sedikit
                btn.style.transition = 'transform 0.2s ease';
                btn.style.transform = 'translateY(-4px)';
            }
        });

        floatContainer.addEventListener('mouseleave', () => {
            hoverTimeout = setTimeout(() => {
                if (!isPopupOpen) {
                    btn.style.transform = 'translateY(0)';
                }
            }, 100);
        });

        console.log('🚀 WhatsApp Popup siap!');
    })();
</script>