<x-controlpanel>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Kamar - Homestay Barijekaden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
            margin: 0;
            padding: 0;
        }
        /* Navbar style for Homestay Barijekaden */
        .navbar {
            background-color: #4A2C00; /* Dark brown color */
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .navbar .nav-links a:hover {
            color: #d1d5db; /* Light gray on hover */
        }

        /* Main content wrapper */
        .main-content-wrapper {
            padding: 2rem 1rem;
            max-width: 1200px; /* Wider content area */
            margin: 0 auto;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
            padding: 1rem 0;
        }
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #d1d5db;
            transform: translateY(-50%);
            z-index: 0;
        }
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            flex: 1;
            text-align: center;
        }
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #d1d5db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .step-item.active .step-circle {
            background-color: #4caf50; /* Green for active step */
        }
        .step-item.completed .step-circle {
            background-color: #10b981; /* Darker green for completed step */
        }
        .step-text {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .step-item.active .step-text,
        .step-item.completed .step-text {
            color: #1f2937;
            font-weight: 600;
        }

        /* Form and Summary Layout */
        .booking-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 1024px) { /* Large screens */
            .booking-layout {
                grid-template-columns: 2fr 1fr; /* Form on left, summary on right */
            }
        }

        /* Form Container */
        .form-section {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .form-section h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="date"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #4b5563;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9ca3af;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4caf50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        .form-group .hint-text {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 1.5rem;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
        }
        .checkbox-group label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0; /* Override default label margin */
        }

        /* Submit Button */
        .submit-button {
            width: 100%;
            padding: 1rem;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
            margin-top: 2rem;
        }
        .submit-button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        /* Summary Section */
        .summary-section {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .summary-section h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            color: #4b5563;
        }
        .summary-item span:first-child {
            font-weight: 500;
        }
        .summary-total {
            border-top: 1px solid #e5e7eb;
            padding-top: 1rem;
            margin-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }
        .help-section {
            background-color: #f0fdf4; /* Light green background */
            border: 1px solid #d1fae5; /* Green border */
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
        }
        .help-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #065f46; /* Dark green text */
            margin-bottom: 0.75rem;
        }
        .help-section p {
            font-size: 0.95rem;
            color: #10b981;
            margin-bottom: 1rem;
        }
        .help-section .contact-link {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .help-section .contact-link:hover {
            background-color: #059669;
        }

        /* Footer */
        .footer {
            background-color: #4A2C00; /* Dark brown color */
            color: white;
            text-align: center;
            padding: 1.5rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <main class="main-content-wrapper">
        <h1 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-8">HOTEL BOOKING</h1>

        <div class="progress-steps">
            <div class="step-item active">
                <div class="step-circle">1</div>
                <span class="step-text">Isi Data</span>
            </div>
            <div class="step-item">
                <div class="step-circle">2</div>
                <span class="step-text">Rincian Pemesanan</span>
            </div>
            <div class="step-item">
                <div class="step-circle">3</div>
                <span class="step-text">Pembayaran</span>
            </div>
            <div class="step-item">
                <div class="step-circle">4</div>
                <span class="step-text">Proses</span>
            </div>
            <div class="step-item">
                <div class="step-circle">5</div>
                <span class="step-text">Voucher Dikirim</span>
            </div>
        </div>

        <div class="booking-layout">
            <div class="form-section">
                <h2>Isi Data</h2>
                <p class="text-gray-600 mb-6 text-sm">Silahkan masukan informasi pemesanan anda melalui formulir pemesanan dibawah ini. Pastikan terisi dengan benar supaya memudahkan proses pemesanan kamar.</p>

                <form id="bookingForm" class="space-y-5">
                    <div class="form-group">
                        <label for="namaKontak">Nama Kontak</label>
                        <input type="text" id="namaKontak" name="namaKontak" placeholder="Isi nama pemesan sesuai KTP/Paspor/SIM (tanpa tanda baca/gelar)" required>
                        <p id="namaKontakError" class="error-message hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="noHandphone">Nomor Handphone</label>
                        <input type="tel" id="noHandphone" name="noHandphone" placeholder="Masukan nomor handphone kontak contoh: +62812345600" required>
                        <p id="noHandphoneError" class="error-message hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="emailKontak">Email Kontak</label>
                        <input type="email" id="emailKontak" name="emailKontak" placeholder="Masukan email yang benar contoh: user@example.com" required>
                        <p id="emailKontakError" class="error-message hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="namaTamu">Nama Tamu</label>
                        <input type="text" id="namaTamu" name="namaTamu" placeholder="Isi nama pemesan sesuai KTP/Paspor/SIM (tanpa tanda baca/gelar), kosongkan bila sama dengan pemesan">
                        <p id="namaTamuError" class="error-message hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="permintaanKhusus">Permintaan Khusus (optional)</label>
                        <textarea id="permintaanKhusus" name="permintaanKhusus" placeholder="Catatan: Permintaan spesifik bergantung pada ketersediaan setiap hotel dan tidak dapat dijamin. Check-in awal atau Transfer Bandara dapat menimbulkan biaya ekstra. Silakan hubung pihak hotel untuk memastikan." rows="4"></textarea>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        <label for="agreeTerms">Saya telah membaca dan menyetujui Syarat dan Ketentuan yang berlaku.</label>
                        <p id="agreeTermsError" class="error-message hidden"></p>
                    </div>

                    <button type="submit" class="submit-button">Lanjutkan Pemesanan</button>
                </form>
            </div>

            <div class="summary-section">
                <h2>Rincian Pemesanan</h2>
                <div class="mb-4">
                    <img src="https://placehold.co/400x250/E0E0E0/333333?text=Gambar%20Kamar" alt="Gambar Kamar" class="w-full h-auto rounded-lg mb-2">
                    <p class="text-lg font-semibold text-gray-800">Standard Fan</p>
                </div>
                
                <div class="summary-item">
                    <span>Checkin</span>
                    <span id="summaryCheckin">Sabtu, 22 Oktober 2016</span>
                </div>
                <div class="summary-item">
                    <span>Checkout</span>
                    <span id="summaryCheckout">Senin, 24 Oktober 2016</span>
                </div>
                <div class="summary-item">
                    <span>Jumlah Malam</span>
                    <span id="summaryJumlahMalam">2 malam</span>
                </div>
                <div class="summary-item">
                    <span>Jumlah Kamar</span>
                    <span id="summaryJumlahKamar">1 kamar</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mt-6 mb-4">Rincian Harga</h3>
                <div class="summary-item">
                    <span>22 Oktober 2016 (1 kamar)</span>
                    <span>Rp. 175.000</span>
                </div>
                <div class="summary-item">
                    <span>24 Oktober 2016 (1 kamar)</span>
                    <span>Rp. 150.000</span>
                </div>
                <div class="summary-total">
                    <span>Total Tagihan</span>
                    <span id="summaryTotalTagihan">Rp. 325.000</span>
                </div>

                <div class="help-section">
                    <h3>Butuh Bantuan?</h3>
                    <p>Kami siap melayani anda dan membantu anda mendapatkan kamar yang terbaik untuk liburan anda, jangan sungkan untuk hubungi kami.</p>
                    <a href="tel:0265-639" class="contact-link">Hubungi 0265-639</a>
                    <a href="#" class="contact-link mt-2">Booking? Chat kami</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Homestay Barijekaden. Web Design By Wiyata Mandalaputra.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingForm = document.getElementById('bookingForm');
            const namaKontakInput = document.getElementById('namaKontak');
            const noHandphoneInput = document.getElementById('noHandphone');
            const emailKontakInput = document.getElementById('emailKontak');
            const namaTamuInput = document.getElementById('namaTamu');
            const permintaanKhususInput = document.getElementById('permintaanKhusus');
            const agreeTermsCheckbox = document.getElementById('agreeTerms');

            // Summary elements
            const summaryCheckin = document.getElementById('summaryCheckin');
            const summaryCheckout = document.getElementById('summaryCheckout');
            const summaryJumlahMalam = document.getElementById('summaryJumlahMalam');
            const summaryJumlahKamar = document.getElementById('summaryJumlahKamar');
            const summaryTotalTagihan = document.getElementById('summaryTotalTagihan');

            // Fungsi untuk menampilkan pesan error
            function showError(element, message) {
                const errorElement = document.getElementById(element.id + 'Error');
                if (errorElement) {
                    errorElement.textContent = message;
                    errorElement.classList.remove('hidden');
                    if (element.type !== 'checkbox') {
                        element.classList.add('border-red-500');
                    }
                }
            }

            // Fungsi untuk menyembunyikan pesan error
            function hideError(element) {
                const errorElement = document.getElementById(element.id + 'Error');
                if (errorElement) {
                    errorElement.classList.add('hidden');
                    if (element.type !== 'checkbox') {
                        element.classList.remove('border-red-500');
                    }
                }
            }

            // Update summary details (dummy data for now)
            function updateSummary() {
                // These values would typically come from a room selection or calculation
                // For this example, they are static as per the image
                summaryCheckin.textContent = 'Sabtu, 22 Oktober 2016';
                summaryCheckout.textContent = 'Senin, 24 Oktober 2016';
                summaryJumlahMalam.textContent = '2 malam';
                summaryJumlahKamar.textContent = '1 kamar';
                summaryTotalTagihan.textContent = 'Rp. 325.000';
            }

            // Initial summary update
            updateSummary();

            // Validasi Form saat Submit
            bookingForm.addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent default form submission

                let isValid = true;

                // Reset all errors
                hideError(namaKontakInput);
                hideError(noHandphoneInput);
                hideError(emailKontakInput);
                hideError(namaTamuInput);
                hideError(permintaanKhususInput);
                hideError(agreeTermsCheckbox);

                // Validate Nama Kontak
                if (!namaKontakInput.value.trim()) {
                    showError(namaKontakInput, 'Nama kontak wajib diisi.');
                    isValid = false;
                }

                // Validate Nomor Handphone
                if (!noHandphoneInput.value.trim()) {
                    showError(noHandphoneInput, 'Nomor handphone wajib diisi.');
                    isValid = false;
                }

                // Validate Email Kontak
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailKontakInput.value.trim() || !emailRegex.test(emailKontakInput.value.trim())) {
                    showError(emailKontakInput, 'Email wajib diisi dan formatnya benar.');
                    isValid = false;
                }

                // Validate Agree Terms checkbox
                if (!agreeTermsCheckbox.checked) {
                    showError(agreeTermsCheckbox, 'Anda harus menyetujui Syarat dan Ketentuan.');
                    isValid = false;
                }

                if (isValid) {
                    // If all validations pass, collect data
                    const bookingData = {
                        namaKontak: namaKontakInput.value.trim(),
                        noHandphone: noHandphoneInput.value.trim(),
                        emailKontak: emailKontakInput.value.trim(),
                        namaTamu: namaTamuInput.value.trim(),
                        permintaanKhusus: permintaanKhususInput.value.trim(),
                        // Add summary data (for display/logging)
                        checkinDate: summaryCheckin.textContent,
                        checkoutDate: summaryCheckout.textContent,
                        jumlahMalam: summaryJumlahMalam.textContent,
                        jumlahKamar: summaryJumlahKamar.textContent,
                        totalTagihan: summaryTotalTagihan.textContent
                    };

                    console.log('Data Pemesanan:', bookingData);
                    
                    // Simulate data submission to backend
                    try {
                        const apiKey = ""; // Leave empty, Canvas will fill it at runtime
                        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`; // Placeholder API
                        
                        // Simulate successful response from server
                        const response = await new Promise(resolve => setTimeout(() => {
                            resolve({
                                ok: true,
                                json: () => Promise.resolve({
                                    message: 'Pemesanan Anda berhasil dikonfirmasi!',
                                    bookingId: 'BOOK' + Date.now()
                                })
                            });
                        }, 1000)); // Simulate 1 second delay

                        if (response.ok) {
                            const data = await response.json();
                            console.log('Response from server (simulated):', data);
                            alert('Pemesanan Berhasil! ' + data.message);
                            bookingForm.reset(); // Reset form after successful submission
                            agreeTermsCheckbox.checked = false; // Reset checkbox too
                        } else {
                            // Handle errors from the server (e.g., status 400, 500)
                            const errorData = await response.json();
                            console.error('Error from server (simulated):', errorData);
                            alert('Terjadi kesalahan saat pemesanan: ' + (errorData.message || 'Silakan coba lagi.'));
                        }
                    } catch (error) {
                        console.error('Error submitting order:', error);
                        alert('Terjadi kesalahan jaringan atau sistem. Silakan coba lagi.');
                    }
                } else {
                    alert('Harap lengkapi semua kolom yang wajib diisi dengan benar.');
                }
            });
        });
    </script>
</body>
</html>
</x-controlpanel>