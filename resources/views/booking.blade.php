<x-controlpanel>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle> 
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking Form - Barijekaden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        *, *::before, *::after {
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Responsive grid for name fields */
            gap: 1rem;
        }

        .form-group .date-select-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); /* Responsive grid for date dropdowns */
            gap: 1rem;
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
        <h1 class="form-title">Room Booking Form</h1>
        <p class="form-description">
            Isi formulir di bawah ini untuk memesan kamar, tentukan tamu yang diharapkan dan jumlah hari menginap, dan kami akan segera menghubungi Anda.
        </p>

        <form id="roomBookingForm" class="space-y-6">
            <div class="form-group">
                <label>Name</label>
                <div class="grid">
                    <input type="text" id="firstName" name="firstName" required placeholder="First Name">
                    <input type="text" id="surname" name="surname" required placeholder="Surname">
                </div>
                <p id="firstNameError" class="error-message hidden"></p>
                <p id="surnameError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required placeholder="ex: myname@example.com">
                <p id="emailHint" class="text-sm text-gray-500 mt-1">example@example.com</p>
                <p id="emailError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="(000) 000-0000">
                <p id="phoneNumberError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label>Arrival Date</label>
                <div class="date-select-grid">
                    <div class="select-wrapper">
                        <select id="arrivalMonth" name="arrivalMonth" required>
                            <option value="">Please select a month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="select-wrapper">
                        <select id="arrivalDay" name="arrivalDay" required>
                            <option value="">Please select a day</option>
                            </select>
                    </div>
                    <div class="select-wrapper">
                        <select id="arrivalYear" name="arrivalYear" required>
                            <option value="">Please select a year</option>
                            </select>
                    </div>
                </div>
                <p id="arrivalDateError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label for="numNights">Number of Nights</label>
                <div class="select-wrapper">
                    <select id="numNights" name="numNights" required>
                        <option value="">Please Select</option>
                        <option value="1">1 Night</option>
                        <option value="2">2 Nights</option>
                        <option value="3">3 Nights</option>
                        <option value="4">4 Nights</option>
                        <option value="5">5 Nights</option>
                        <option value="6">6 Nights</option>
                        <option value="7">7 Nights</option>
                        <option value="8">8 Nights</option>
                        <option value="9">9 Nights</option>
                        <option value="10">10 Nights</option>
                        <option value="11">11 Nights</option>
                        <option value="12">12 Nights</option>
                        <option value="13">13 Nights</option>
                        <option value="14">14 Nights</option>
                    </select>
                </div>
                <p id="numNightsError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label for="numGuests">Number of Guests</label>
                <div class="select-wrapper">
                    <select id="numGuests" name="numGuests" required>
                        <option value="">Please Select</option>
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                        <option value="5">5 Guests</option>
                    </select>
                </div>
                <p id="numGuestsError" class="error-message hidden"></p>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="4" placeholder=""></textarea>
            </div>

            <button type="submit" class="send-request-button">Send Request</button>
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
                daySelect.innerHTML = '<option value="">Please select a day</option>'; // Clear existing options

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

                // Validate Name
                if (!firstNameInput.value.trim()) {
                    showError(firstNameInput, 'First Name is required.');
                    isValid = false;
                }
                if (!surnameInput.value.trim()) {
                    showError(surnameInput, 'Surname is required.');
                    isValid = false;
                }

                // Validate Email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                    showError(emailInput, 'Valid email is required.');
                    isValid = false;
                }

                // Validate Phone Number (optional in this form, but can add validation if needed)
                // if (!phoneNumberInput.value.trim()) {
                //     showError(phoneNumberInput, 'Phone Number is required.');
                //     isValid = false;
                // }

                // Validate Arrival Date
                if (!arrivalMonthSelect.value || !arrivalDaySelect.value || !arrivalYearSelect.value) {
                    showError(arrivalMonthSelect, 'Full Arrival Date is required.'); // Generic error for date group
                    showError(arrivalDaySelect, ''); // Clear specific day error if month/year are missing
                    showError(arrivalYearSelect, ''); // Clear specific year error if month/day are missing
                    isValid = false;
                } else {
                    const selectedDate = new Date(`${arrivalYearSelect.value}-${arrivalMonthSelect.value}-${arrivalDaySelect.value}`);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0); // Reset time for comparison
                    if (selectedDate < today) {
                        showError(arrivalMonthSelect, 'Arrival Date cannot be in the past.');
                        isValid = false;
                    }
                }

                // Validate Number of Nights
                if (!numNightsSelect.value) {
                    showError(numNightsSelect, 'Number of Nights is required.');
                    isValid = false;
                }

                // Validate Number of Guests
                if (!numGuestsSelect.value) {
                    showError(numGuestsSelect, 'Number of Guests is required.');
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
                        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
                        
                        // Using a simple alert for success/failure as per previous examples
                        // In a real application, you'd send bookingData to a backend.
                        alert('Permintaan Pemesanan Terkirim! Kami akan segera menghubungi Anda.');
                        form.reset(); // Clear the form
                        populateDays(); // Re-populate days after reset
                    } catch (error) {
                        console.error('Error submitting booking:', error);
                        alert('Terjadi kesalahan saat mengirim permintaan pemesanan. Silakan coba lagi.');
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