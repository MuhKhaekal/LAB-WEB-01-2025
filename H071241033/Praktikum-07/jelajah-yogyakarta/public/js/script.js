// MENGATUR MANIPULASI HEADING DAN NAVBAR
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    const nav = document.getElementById('nav');
    const cta = document.getElementById('cta');

    if (!navbar || !nav) return;

    if (window.scrollY > 60) {
        navbar.classList.add('fixed', 'bg-beige');
        navbar.classList.add('transition-all', 'duration-300', 'ease-in-out');
        navbar.classList.remove('absolute');
        nav.classList.replace('text-beige', 'text-mocha');
        nav.classList.add('transition-all', 'duration-300', 'ease-in');
        cta.classList.replace('border-beige', 'border-mocha')
    } else if (window.scrollY <= 2) {
        navbar.classList.add('absolute');
        navbar.classList.remove('fixed', 'bg-beige', 'shadow-md');
        navbar.classList.remove('transition-all', 'duration-300', 'ease-in-out');
        nav.classList.replace('text-mocha', 'text-beige');
        nav.classList.remove('transition-all', 'duration-300', 'ease-in');
        cta.classList.replace('border-mocha', 'border-beige')

    }
});

// MENGATUR ANIMASI COUNTER DI HOME PAGE
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');

    const startCounting = (counter) => {
        const target = +counter.getAttribute('data-target');
        const speed = 150;
        let count = 0;

        const increment = target / speed;

        const updateCount = () => {
            count += increment;
            if (count < target) {
                counter.textContent = Math.ceil(count);
                requestAnimationFrame(updateCount);
            } else {
                counter.textContent = target;
            }
        };

        updateCount();
    };

    // pakai Intersection Observer biar animasi muncul saat elemen terlihat
    counters.forEach(counter => {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounting(counter);
                    observer.unobserve(counter); // biar cuma jalan sekali per elemen
                }
            });
        }, { threshold: 0.2 }); // 0.2 artinya elemen kelihatan 20% aja udah cukup

        observer.observe(counter);
    });
});

// MENGATUR CTA BUTTON DI GALERY PAGE
document.addEventListener('DOMContentLoaded', () => {
    const galeryContainer = document.getElementById('galery-container');
    const galeryCTA = document.getElementById('galery-cta');

    galeryCTA.addEventListener('click', (event) => {
        // cegah reload halaman
        event.preventDefault();

        galeryContainer.classList.remove('hidden');
        galeryContainer.classList.add('block');

        galeryContainer.scrollIntoView({ behavior: 'smooth' });
    });
});


// MENGATUR MUSIK PLAY/MUTED
document.addEventListener('DOMContentLoaded', () => {
    const bgMusic = document.getElementById('bgMusic');
    const toggle = document.getElementById('toggleMusic');

    // ambil status mute sebelumnya
    const savedMuted = localStorage.getItem('musicMuted');
    if (savedMuted === 'false') bgMusic.muted = false;

    // update teks tombol sesuai status
    toggle.textContent = bgMusic.muted ? '🔇 Music Off' : '🔊 Music On';

    // tombol toggle
    toggle.addEventListener('click', () => {
        bgMusic.muted = !bgMusic.muted;
        toggle.textContent = bgMusic.muted ? '🔇 Music Off' : '🔊 Music On';
        localStorage.setItem('musicMuted', bgMusic.muted);
    });
});

/* ============================================== */
/* FUNGSI LIGHTBOX (MODAL GAMBAR)               */
/* ============================================== */
/* ============================================== */
/* FUNGSI LIGHTBOX (MODAL GAMBAR)               */
/* ============================================== */
function initImageModal() {
    
    // 1. Ambil elemen-elemen modal
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImageContent');
    const closeButton = document.getElementById('modalCloseBtn');
    const modalBackdrop = document.getElementById('modalBackdropContent');

    if (!modal || !modalImage || !closeButton || !modalBackdrop) {
        return;
    }

    // 2. Ambil SEMUA gambar yang bisa diklik
    const allGalleryImages = document.querySelectorAll('.gallery-image-trigger');

    // 3. Fungsi untuk membuka modal (versi Tailwind)
    function openModal(event) {
        const newImageSrc = this.dataset.imageSrc; 
        modalImage.src = newImageSrc;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
        }, 10); 
    }

    // 4. Fungsi untuk menutup modal (versi Tailwind)
    function closeModal() {
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modalImage.src = ''; 
        }, 300);
    }

    // 5. Pasang 'listener' ke setiap gambar galeri
    allGalleryImages.forEach(img => {
        img.addEventListener('click', openModal);
    });

    // 6. Pasang 'listener' untuk menutup modal
    closeButton.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target === modalBackdrop) {
            closeModal();
        }
    });

    // 7. Tambahkan listener untuk tombol 'Escape' (Tetap sama)
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

document.addEventListener('DOMContentLoaded', initImageModal);