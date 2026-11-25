document.addEventListener('DOMContentLoaded', () => {

    // 1. TOGGLE DARK / LIGHT MODE
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            themeToggleBtn.innerText = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
        });
    }

    // 2. HAMBURGER MENU MOBILE
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const navLinks = document.querySelector('.nav-links');
    if (hamburgerBtn && navLinks) {
        hamburgerBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Tutup menu saat link diklik
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
    }

    // 3. ACCORDION (EXPERIENCE & EDUCATION)
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const accordionItem = header.closest('.accordion-item');
            if (accordionItem) {
                accordionItem.classList.toggle('active');
            }
        });
    });

    // 4. HIGHLIGHT EXPERTISE CARDS
    const expertiseCards = document.querySelectorAll('.expertise-card');
    expertiseCards.forEach(card => {
        card.addEventListener('click', () => {
            expertiseCards.forEach(c => {
                if (c !== card) c.classList.remove('highlighted');
            });
            card.classList.toggle('highlighted');
        });
    });

 // 5. VALIDASI & PENGIRIMAN FORM KONTAK
const form = document.querySelector('.contact-form');
if (form) {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subjek');
    const pesanInput = document.getElementById('pesan');

    form.addEventListener('submit', (e) => {
        // Tahan submit otomatis untuk jalankan validasi JS dulu
        e.preventDefault();

        const nameVal = nameInput.value.trim();
        const emailVal = emailInput.value.trim();
        const subjectVal = subjectInput.value.trim();
        const pesanVal = pesanInput.value.trim();

        clearErrors();

        let isValid = true;

        if (nameVal === '') {
            showError(nameInput, 'Nama wajib diisi.');
            isValid = false;
        }

        if (emailVal === '') {
            showError(emailInput, 'Email wajib diisi.');
            isValid = false;
        } else if (!emailVal.includes('@')) {
            showError(emailInput, 'Format email harus mengandung karakter @.');
            isValid = false;
        }

        if (subjectVal === '') {
            showError(subjectInput, 'Subjek wajib diisi.');
            isValid = false;
        }

        if (pesanVal === '') {
            showError(pesanInput, 'Pesan wajib diisi.');
            isValid = false;
        }

        // Jika semua input valid, teruskan pengiriman form ke URL/PHP
        if (isValid) {
            form.submit(); 
        }
    });

    function showError(inputElement, message) {
        const formGroup = inputElement.parentElement;
        const errorText = document.createElement('small');
        errorText.className = 'error-message';
        errorText.style.color = '#e74c3c';
        errorText.style.fontSize = '0.85rem';
        errorText.style.marginTop = '4px';
        errorText.style.display = 'block';
        errorText.innerText = message;

        formGroup.appendChild(errorText);
        inputElement.style.borderColor = '#e74c3c';
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        [nameInput, emailInput, subjectInput, pesanInput].forEach(input => {
            if (input) input.style.borderColor = '';
        });
    }
}
});