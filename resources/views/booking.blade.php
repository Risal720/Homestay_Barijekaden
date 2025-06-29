<x-controlpanel>

    <x-slot:title>{{ $title }}</x-slot:title>
    <head>
        <style>
            /* Tambahkan ini untuk memastikan html dan body direset dengan benar */
            html .body {
                margin: 0;
                padding: 0;
                height: 100%;
                width: 100%;
                box-sizing: border-box; /* Penting untuk konsistensi model box */
                overflow-x: hidden; /* Tambahkan ini sebagai pengaman tambahan jika perlu */
            }

            *,
            *::before,
            *::after {
                box-sizing: inherit;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: #f0f4f8; /* Light blue-gray background */
                margin: 0; /* Pastikan margin 0 */
                padding: 0; /* Pastikan padding 0 */
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center; /* Center content horizontally */
                justify-content: flex-start; /* Align content to the top */
                overflow-y: hidden; /* Allow scrolling for the entire page */
                overflow-x: hidden; /* Prevent horizontal scroll */
            }


            /* Main container for the form */
            .form-container {
                background-color: white;
                padding: 2.5rem;
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-width: 700px; /* Max width for the form */
                width: 100%; /* Responsive width */
                margin-top: 3rem; /* Space from the top */
                margin-bottom: 3rem; /* Space from the bottom */
                /* Tidak perlu margin-left/right: auto; karena body sudah align-items: center */

            }

            .form-title {
                font-size: 2.25rem; /* H1 size */
                font-weight: 700;
                color: #1f2937; /* Dark gray text */
                margin-bottom: 2rem;
                text-align: center;
            }

            .form-description {
                font-size: 1rem;
                color: #6b7280; /* Medium gray text */
                text-align: center;
                margin-bottom: 2.5rem;
                line-height: 1.5;
            }

            /* Form group styling */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #374151; /* Darker gray for labels */
            }

            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="tel"],
            .form-group textarea,
            .form-group select {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db; /* Light gray border */
                border-radius: 0.375rem; /* Rounded corners */
                font-size: 1rem;
                color: #4b5563; /* Input text color */
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .form-group input::placeholder,
            .form-group textarea::placeholder {
                color: #9ca3af; /* Placeholder text color */
            }

            .form-group input:focus,
            .form-group textarea:focus,
            .form-group select:focus {
                outline: none;
                border-color: #3b82f6; /* Blue focus border */
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2); /* Light blue shadow on focus */
            }

            .form-group .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                /* Responsive grid for name fields */
                gap: 2rem; /* Sudah diubah menjadi 2rem pada jawaban sebelumnya */
            }

            .form-group .date-select-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                /* Responsive grid for date dropdowns */
                gap: 2rem; /* <--- Diubah menjadi 2rem untuk jarak yang lebih jelas */
            }

            /* Custom styling for select arrows */
            .select-wrapper {
                position: relative;
            }

            .select-wrapper::after {
                content: '▼';
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #6b7280; /* Gray arrow color */
                pointer-events: none; /* Allow clicks to pass through */
            }

            .select-wrapper select {
                appearance: none; /* Remove default arrow */
                -webkit-appearance: none;
                -moz-appearance: none;
                cursor: pointer;
            }

            /* Send Request Button */
            .send-request-button {
                width: 100%;
                padding: 1rem;
                background-color: #1f2937; /* Dark blue from image */
                color: white;
                border: none;
                border-radius: 0.375rem; /* Rounded corners */
                font-size: 1.125rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-top: 2rem;
            }

            .send-request-button:hover {
                background-color: #374151; /* Slightly lighter dark blue on hover */
                transform: translateY(-2px);
            }

            .error-message {
                color: #ef4444; /* Red for errors */
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }
        </style>
    </head>

    <body>
        <div class="form-container">
            <h1 class="form-title">Formulir Pemesanan Kamar</h1>
            <p class="form-description">
                Isi formulir di bawah ini untuk memesan kamar, tentukan tamu yang diharapkan dan jumlah hari menginap,
                dan kami akan segera menghubungi Anda.
            </p>

            <form id="roomBookingForm" class="space-y-6">
                <div class="form-group">
                    <label>Nama</label>
                    <div class="grid">
                        <input type="text" id="firstName" name="firstName" required placeholder="Nama Depan">
                        <input type="text" id="surname" name="surname" required placeholder="Nama Belakang">
                    </div>
                    <p id="firstNameError" class="error-message hidden"></p>
                    <p id="surnameError" class="error-message hidden"></p>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="contoh: nama_saya@contoh.com">
                    <p id="emailHint" class="text-sm text-gray-500 mt-1">contoh@contoh.com</p>
                    <p id="emailError" class="error-message hidden"></p>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Nomor Telepon</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="(000) 000-0000">
                    <p id="phoneNumberError" class="error-message hidden"></p>
                </div>

                <div class="form-group">
                    <label>Tanggal Kedatangan</label>
                    <div class="date-select-grid">
                        <div class="select-wrapper">
                            <select id="arrivalMonth" name="arrivalMonth" required>
                                <option value="">Pilih bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="select-wrapper">
                            <select id="arrivalDay" name="arrivalDay" required>
                                <option value="">Pilih tanggal</option>
                            </select>
                        </div>
                        <div class="select-wrapper">
                            <select id="arrivalYear" name="arrivalYear" required>
                                <option value="">Pilih tahun</option>
                            </select>
                        </div>
                    </div>
                    <p id="arrivalDateError" class="error-message hidden"></p>
                </div>

                <div class="form-group">
                    <label for="numNights">Jumlah Malam</label>
                    <div class="select-wrapper">
                        <select id="numNights" name="numNights" required>
                            <option value="">Pilih</option>
                            <option value="1">1 Malam</option>
                            <option value="2">2 Malam</option>
                            <option value="3">3 Malam</option>
                            <option value="4">4 Malam</option>
                            <option value="5">5 Malam</option>
                            <option value="6">6 Malam</option>
                            <option value="7">7 Malam</option>
                            <option value="8">8 Malam</option>
                            <option value="9">9 Malam</option>
                            <option value="10">10 Malam</option>
                            <option value="11">11 Malam</option>
                            <option value="12">12 Malam</option>
                            <option value="13">13 Malam</option>
                            <option value="14">14 Malam</option>
                        </select>
                    </div>
                    <p id="numNightsError" class="error-message hidden"></p>
                </div>

                <div class="form-group">
                    <label for="numGuests">Jumlah Tamu</label>
                    <div class="select-wrapper">
                        <select id="numGuests" name="numGuests" required>
                            <option value="">Pilih</option>
                            <option value="1">1 Tamu</option>
                            <option value="2">2 Tamu</option>
                            <option value="3">3 Tamu</option>
                            <option value="4">4 Tamu</option>
                            <option value="5">5 Tamu</option>
                        </select>
                    </div>
                    <p id="numGuestsError" class="error-message hidden"></p>
                </div>


                <div class="form-group">
                    <label for="notes">Catatan</label>
                    <textarea id="notes" name="notes" rows="4" placeholder=""></textarea>
                </div>

                <button type="submit" class="send-request-button">Kirim Permintaan</button>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('roomBookingForm');
                const firstNameInput = document.getElementById('firstName');
                const surnameInput = document.getElementById('surname');
                const emailInput = document.getElementById('email');
                const phoneNumberInput = document.getElementById('phoneNumber');
                const arrivalMonthSelect = document.getElementById('arrivalMonth');
                const arrivalDaySelect = document.getElementById('arrivalDay');
                const arrivalYearSelect = document.getElementById('arrivalYear');
                const numNightsSelect = document.getElementById('numNights');
                const numGuestsSelect = document.getElementById('numGuests');
                const notesTextarea = document.getElementById('notes');

                // --- Utility Functions for Form ---
                function showError(element, message) {
                    const errorElement = document.getElementById(element.id + 'Error');
                    if (errorElement) {
                        errorElement.textContent = message;
                        errorElement.classList.remove('hidden');
                        element.classList.add('border-red-500');
                    }
                }

                function hideError(element) {
                    const errorElement = document.getElementById(element.id + 'Error');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                        element.classList.remove('border-red-500');
                    }
                }

                // --- Populate Year Dropdown ---
                function populateYears() {
                    const currentYear = new Date().getFullYear();
                    // Clear existing options first, except "Pilih tahun"
                    arrivalYearSelect.innerHTML = '<option value="">Pilih tahun</option>';
                    for (let i = 0; i < 5; i++) { // Next 5 years
                        const year = currentYear + i;
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        arrivalYearSelect.appendChild(option);
                    }
                }

                // --- Populate Day Dropdown based on Month and Year ---
                function populateDays() {
                    const year = parseInt(arrivalYearSelect.value);
                    const month = parseInt(arrivalMonthSelect.value);
                    const daySelect = arrivalDaySelect;
                    daySelect.innerHTML =
                        '<option value="">Pilih tanggal</option>'; // Clear existing options

                    if (year && month) {
                        const daysInMonth = new Date(year, month, 0).getDate();
                        for (let i = 1; i <= daysInMonth; i++) {
                            const option = document.createElement('option');
                            option.value = String(i).padStart(2, '0');
                            option.textContent = i;
                            daySelect.appendChild(option);
                        }
                    }
                }

                // --- Event Listeners for Date Dropdowns ---
                arrivalMonthSelect.addEventListener('change', populateDays);
                arrivalYearSelect.addEventListener('change', populateDays);

                // Initial population
                populateYears();
                populateDays(); // Call once to populate days if month/year are pre-selected or default

                // --- Form Validation and Submission ---
                form.addEventListener('submit', async function(event) {
                    event.preventDefault();

                    let isValid = true;

                    // Reset errors
                    hideError(firstNameInput);
                    hideError(surnameInput);
                    hideError(emailInput);
                    hideError(phoneNumberInput);
                    hideError(arrivalMonthSelect);
                    hideError(arrivalDaySelect);
                    hideError(arrivalYearSelect);
                    hideError(numNightsSelect);
                    hideError(numGuestsSelect);

                    // Validate Nama Depan
                    if (!firstNameInput.value.trim()) {
                        showError(firstNameInput, 'Nama Depan wajib diisi.');
                        isValid = false;
                    }
                    // Validate Nama Belakang
                    if (!surnameInput.value.trim()) {
                        showError(surnameInput, 'Nama Belakang wajib diisi.');
                        isValid = false;
                    }

                    // Validate Email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                        showError(emailInput, 'Email yang valid wajib diisi.');
                        isValid = false;
                    }

                    // Validate Nomor Telepon (opsional di sini, namun bisa ditambahkan validasi jika diperlukan)
                    // if (!phoneNumberInput.value.trim()) {
                    //      showError(phoneNumberInput, 'Nomor Telepon wajib diisi.');
                    //      isValid = false;
                    // }

                    // Validate Tanggal Kedatangan
                    if (!arrivalMonthSelect.value || !arrivalDaySelect.value || !arrivalYearSelect
                        .value) {
                        showError(arrivalMonthSelect,
                            'Tanggal Kedatangan lengkap wajib diisi.'); // Kesalahan umum untuk grup tanggal
                        showError(arrivalDaySelect,
                            ''); // Hapus kesalahan spesifik tanggal jika bulan/tahun hilang
                        showError(arrivalYearSelect,
                            ''); // Hapus kesalahan spesifik tahun jika bulan/tanggal hilang
                        isValid = false;
                    } else {
                        const selectedDate = new Date(
                            `${arrivalYearSelect.value}-${arrivalMonthSelect.value}-${arrivalDaySelect.value}`
                        );
                        const today = new Date();
                        today.setHours(0, 0, 0, 0); // Reset waktu untuk perbandingan
                        if (selectedDate < today) {
                            showError(arrivalMonthSelect, 'Tanggal Kedatangan tidak bisa di masa lalu.');
                            isValid = false;
                        }
                    }

                    // Validate Jumlah Malam
                    if (!numNightsSelect.value) {
                        showError(numNightsSelect, 'Jumlah Malam wajib diisi.');
                        isValid = false;
                    }

                    // Validate Jumlah Tamu
                    if (!numGuestsSelect.value) {
                        showError(numGuestsSelect, 'Jumlah Tamu wajib diisi.');
                        isValid = false;
                    }

                    if (isValid) {
                        const bookingData = {
                            firstName: firstNameInput.value.trim(),
                            surname: surnameInput.value.trim(),
                            email: emailInput.value.trim(),
                            phoneNumber: phoneNumberInput.value.trim(),
                            arrivalDate: `${arrivalYearSelect.value}-${arrivalMonthSelect.value}-${arrivalDaySelect.value}`,
                            numNights: numNightsSelect.value,
                            numGuests: numGuestsSelect.value,
                            notes: notesTextarea.value.trim()
                        };

                        console.log('Booking Data:', bookingData);

                        // Simulate API call
                        try {
                            const apiKey = ""; // Leave empty, Canvas will fill it at runtime
                            const apiUrl =
                                `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                            // Menggunakan alert sederhana untuk keberhasilan/kegagalan seperti contoh sebelumnya
                            // Dalam aplikasi nyata, Anda akan mengirim bookingData ke backend.
                            alert(
                                'Permintaan Pemesanan Terkirim! Kami akan segera menghubungi Anda.');
                            form.reset(); // Mengosongkan formulir
                            populateDays(); // Mengisi ulang hari setelah reset
                        } catch (error) {
                            console.error('Error submitting booking:', error);
                            alert(
                                'Terjadi kesalahan saat mengirim permintaan pemesanan. Silakan coba lagi.');
                        }
                    }
                });
            });
        </script>
    </body>

</x-controlpanel>