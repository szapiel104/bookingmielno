@extends('layouts.app')

@section('title', 'Rezerwuj Apartament - Mielno')

@section('additional_styles')
<style>
    .flatpickr-day.booked {
        background: #dc2626;
        color: white;
    }

    .flatpickr-day.disabled {
        background: #fca5a5;
    }
</style>
@endsection

@section('content')
<section class="hero-section">
    <div class="container">
        <h1>{{ $hero_title }}</h1>
        <p>{{ $hero_subtitle }}</p>
    </div>
</section>

<section id="booking" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="booking-form" x-data="bookingForm()" x-init="init()">
                    <h3 class="mb-4 text-center">Zarezerwuj swój pobyt</h3>
                    
                    <form @submit.prevent="submitBooking">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Imię i Nazwisko</label>
                                <input type="text" class="form-control" name="guest_name" x-model="form.guest_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="guest_email" x-model="form.guest_email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telefon</label>
                                <input type="tel" class="form-control" name="guest_phone" x-model="form.guest_phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Liczba gości</label>
                                <input type="number" class="form-control" value="2" min="1" max="4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data Przyjazdu</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="check_in_date"
                                    x-model="form.check_in_date"
                                    required
                                    id="checkin">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data Wyjazdu</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="check_out_date"
                                    x-model="form.check_out_date"
                                    required
                                    id="checkout">
                            </div>
                        </div>

                        <div class="alert alert-warning" x-show="validationMessage" x-text="validationMessage"></div>

                        <div class="price-display" x-show="price.total_price > 0">
                            <p class="mb-2"><strong x-text="`Liczba nocy: ${price.nights}`"></strong></p>
                            <p class="mb-2"><strong x-text="`Cena za noc: ${price.price_per_night.toFixed(2)} PLN`"></strong></p>
                            <h3><strong x-text="`Razem: ${price.total_price.toFixed(2)} PLN`"></strong></h3>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Specjalne Życzenia (opcjonalnie)</label>
                            <textarea class="form-control" name="special_requests" x-model="form.special_requests" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100" :disabled="loading">
                            <span x-show="!loading">Wyślij Rezerwację</span>
                            <span x-show="loading">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Przetwarzanie...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about-section">
    <div class="container">
        <h2>{{ $about_title }}</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                    {!! nl2br(e($about_text)) !!}
                </p>
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">💰 Przystępna Cena</h5>
                                <p class="card-text">{{ $price_per_night }} PLN za noc</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">🏘️ Idealna Lokalizacja</h5>
                                <p class="card-text">Centrum Mielna, blisko plaży</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="calendar" class="py-5" style="background: white;">
    <div class="container">
        <h2 class="text-center mb-4">Kalendarz Dostępności</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="calendar-container" id="calendar"></div>
                <div class="mt-3">
                    <span class="me-3"><span style="display: inline-block; width: 15px; height: 15px; background: #16a34a; margin-right: 5px;"></span>Dostępne</span>
                    <span><span style="display: inline-block; width: 15px; height: 15px; background: #dc2626; margin-right: 5px;"></span>Zarezerwowane</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="contact-section">
    <div class="container">
        <h2>{{ $contact_text }}</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <h5>📍 Adres</h5>
                <p>Mielno, Polska</p>
            </div>
            <div class="col-md-4">
                <h5>📞 Telefon</h5>
                <p>{{ \App\Models\Setting::get('phone', '+48 123 456 789') }}</p>
            </div>
            <div class="col-md-4">
                <h5>📧 E-mail</h5>
                <p>{{ \App\Models\Setting::get('notification_email', 'admin@Mielno.pl') }}</p>
            </div>
        </div>
    </div>
</section>

@endsection

@section('additional_scripts')
<script>
function bookingForm() {
    return {
        form: {
            guest_name: '',
            guest_email: '',
            guest_phone: '',
            check_in_date: '',
            check_out_date: '',
            special_requests: '',
        },
        price: {
            nights: 0,
            min_nights: {{ $min_nights }},
            price_per_night: {{ $price_per_night }},
            total_price: 0,
        },
        loading: false,
        bookedDates: [],
        validationMessage: '',
        checkinPicker: null,
        checkoutPicker: null,

        init() {
            this.loadAvailability();
        },

        initializeDatePickers() {
            this.checkinPicker = flatpickr('#checkin', {
                locale: 'pl',
                minDate: new Date(),
                dateFormat: 'Y-m-d',
                disable: this.bookedDates,
                onChange: (selectedDates, dateStr) => {
                    this.form.check_in_date = dateStr;
                    this.syncCheckoutMinDate();
                    this.calculatePrice();
                },
            });

            this.checkoutPicker = flatpickr('#checkout', {
                locale: 'pl',
                minDate: new Date(),
                dateFormat: 'Y-m-d',
                disable: this.bookedDates,
                onChange: (selectedDates, dateStr) => {
                    this.form.check_out_date = dateStr;
                    this.calculatePrice();
                },
            });
        },

        syncCheckoutMinDate() {
            if (!this.form.check_in_date || !this.checkoutPicker) {
                return;
            }

            const checkInDate = new Date(this.form.check_in_date + 'T00:00:00');
            checkInDate.setDate(checkInDate.getDate() + Number(this.price.min_nights || 1));
            this.checkoutPicker.set('minDate', checkInDate);

            if (this.form.check_out_date) {
                const checkOutDate = new Date(this.form.check_out_date + 'T00:00:00');
                if (checkOutDate < checkInDate) {
                    this.form.check_out_date = '';
                    this.checkoutPicker.clear();
                    this.price.total_price = 0;
                    this.validationMessage = `Minimalna liczba nocy to ${this.price.min_nights}.`;
                }
            }
        },

        calculateNights() {
            if (!this.form.check_in_date || !this.form.check_out_date) {
                return 0;
            }

            const checkInDate = new Date(this.form.check_in_date + 'T00:00:00');
            const checkOutDate = new Date(this.form.check_out_date + 'T00:00:00');
            return Math.round((checkOutDate - checkInDate) / 86400000);
        },

        syncDatesFromInputs() {
            const checkInInput = document.getElementById('checkin');
            const checkOutInput = document.getElementById('checkout');

            this.form.check_in_date = checkInInput ? checkInInput.value : this.form.check_in_date;
            this.form.check_out_date = checkOutInput ? checkOutInput.value : this.form.check_out_date;
        },

        loadAvailability() {
            fetch('/api/availability')
                .then(response => response.json())
                .then(data => {
                    this.bookedDates = data.booked_dates;
                    this.initializeDatePickers();
                    this.initializeCalendar();
                });
        },

        initializeCalendar() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pl',
                events: this.bookedDates.map(date => ({
                    start: date,
                    end: new Date(new Date(date).getTime() + 86400000).toISOString().split('T')[0],
                    title: 'Zajete',
                    display: 'background',
                    backgroundColor: '#dc2626',
                })),
            });
            calendar.render();
        },

        calculatePrice() {
            this.syncDatesFromInputs();
            if (!this.form.check_in_date || !this.form.check_out_date) return;

            const nights = this.calculateNights();
            if (nights < Number(this.price.min_nights || 1)) {
                this.price.total_price = 0;
                this.validationMessage = `Minimalna liczba nocy to ${this.price.min_nights}.`;
                return;
            }

            fetch('/api/calculate-price', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({
                    check_in: this.form.check_in_date,
                    check_out: this.form.check_out_date,
                }),
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Nieprawidlowe daty.');
                }
                return data;
            })
            .then(data => {
                this.price = data;
                this.validationMessage = '';
            })
            .catch(error => {
                this.price.total_price = 0;
                this.validationMessage = error.message;
            });
        },

        submitBooking() {
            this.syncDatesFromInputs();
            this.calculatePrice();

            if (!this.form.check_in_date || !this.form.check_out_date) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sprawdz daty',
                    text: 'Wybierz poprawna date przyjazdu i wyjazdu.',
                });
                return;
            }

            if (this.validationMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sprawdz daty',
                    text: this.validationMessage,
                });
                return;
            }

            this.loading = true;

            fetch('/api/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify(this.form),
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Nie udalo sie wyslac rezerwacji.');
                }
                return data;
            })
            .then(data => {
                this.loading = false;
                if (data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rezerwacja przyjęta!',
                        text: data.message,
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                this.loading = false;
                Swal.fire({
                    icon: 'error',
                    title: 'Blad',
                    text: error.message,
                });
            });
        },
    };
}
</script>
@endsection
