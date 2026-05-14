@extends('layouts.app')
@section('title', 'Rezerwacja')

@section('additional_styles')
<style>
    .booking-page {
        --booking-line: #d8dbe1;
        --booking-muted: #4b5563;
        --booking-accent: #2fc96f;
        --booking-soft: #f7f8f9;
        font-family: 'Space Grotesk', sans-serif;
    }

    .booking-page .hero-panel {
        border: 1px solid var(--booking-line);
        border-radius: 1.4rem;
        background: linear-gradient(130deg, #f7f8f9 0%, #edf0f2 100%);
        padding: 2rem;
        margin-bottom: 1.25rem;
    }

    .booking-page .hero-panel h1 {
        font-size: clamp(2rem, 4vw, 2.9rem);
        line-height: 1.05;
        font-weight: 700;
    }

    .booking-page .hero-panel p {
        color: var(--booking-muted);
        max-width: 52ch;
    }

    .booking-page .info-chip {
        border: 1px solid #cfd4dd;
        background: #f1f3f6;
        border-radius: 999px;
        padding: 0.45rem 0.9rem;
        font-size: 0.92rem;
        font-weight: 600;
        color: #111827;
    }

    .booking-page .panel-card {
        border: 1px solid var(--booking-line);
        background: var(--booking-soft);
        border-radius: 1.1rem;
        padding: 1rem;
    }

    .booking-page .legend-dot {
        width: 14px;
        height: 14px;
        border-radius: 4px;
        display: inline-block;
        margin-right: 6px;
    }

    .booking-page #bookingForm {
        border: 1px solid var(--booking-line);
        background: #fff;
    }

    .booking-page #bookingForm .btn-primary {
        background: var(--booking-accent);
        color: #03200e;
        border: 0;
        font-weight: 700;
    }

    .booking-page #bookingForm .btn-primary:hover {
        background: #1bb65a;
        color: #03150a;
    }

    @media (max-width: 767.98px) {
        .booking-page .hero-panel {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 1rem;
        }

        .booking-page .hero-panel h1 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .booking-page .hero-panel p {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .booking-page .d-flex.flex-wrap.gap-2 {
            gap: 0.5rem !important;
        }

        .booking-page .info-chip {
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }

        .booking-page .panel-card {
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .booking-page .legend-dot {
            width: 12px;
            height: 12px;
            margin-right: 4px;
        }

        .booking-page .row.g-4 {
            gap: 1rem !important;
        }

        .booking-page .calendar-container {
            padding: 10px;
            margin: 15px 0;
        }

        .booking-page .fc {
            font-size: 0.8rem;
        }

        .booking-page .fc-daygrid-day-frame {
            min-height: 50px;
        }

        .booking-page #bookingForm {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5 booking-page">
    <section class="hero-panel">
        <h1 class="mb-3">Rezerwacja apartamentu w Mielnie</h1>
        <p class="mb-3">Wypełnij formularz, wybierz datę przyjazdu i wyjazdu, a my szybko potwierdzimy dostępność terminu. Wszystko w jednym miejscu, bez zbędnych kroków.</p>
        <div class="d-flex flex-wrap gap-2">
            <span class="info-chip">blisko plaży</span>
            <span class="info-chip">pełne wyposażenie</span>
            <span class="info-chip">szybkie potwierdzenie</span>
        </div>
    </section>

    <div class="row g-4 align-items-start justify-content-center">
        <div class="col-12 col-lg-5">
            @include('booking._form')
        </div>
        <div class="col-12 col-lg-7">
            <div class="mb-3">
                <div class="calendar-container mb-0" id="calendar"></div>
            </div>
            <div class="panel-card text-center">
                <span class="me-3"><span class="legend-dot" style="background: #7C83FD;"></span>Dostępne</span>
                <span><span class="legend-dot" style="background: #FF6A6A;"></span>Zarezerwowane</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    let currentCalendar = null;
    let checkinPicker = null;
    let checkoutPicker = null;

    function refreshCalendarAndDatePickers() {
        fetch('/api/availability')
            .then(response => response.json())
            .then(data => {
                const bookedDates = data.booked_dates;
                const calendarEl = document.getElementById('calendar');

                // Zniszcz stary kalendarz jeśli istnieje
                if (currentCalendar) {
                    currentCalendar.destroy();
                }

                // Stwórz nowy kalendarz z zaktualizowanymi datami
                currentCalendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'pl',
                    height: 400,
                    events: bookedDates.map(date => ({
                        start: date,
                        end: new Date(new Date(date).getTime() + 86400000).toISOString().split('T')[0],
                        display: 'background',
                        backgroundColor: '#FF6A6A'
                    }))
                });
                currentCalendar.render();

                // Uaktualnij datepickery
                if (checkinPicker) {
                    checkinPicker.destroy();
                }
                if (checkoutPicker) {
                    checkoutPicker.destroy();
                }

                checkinPicker = flatpickr('#checkin', {
                    locale: 'pl',
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    disable: bookedDates,
                    onChange: function(selectedDates, dateStr) {
                        // Ustaw minDate dla checkout na dzień PO check-in
                        if (selectedDates.length > 0) {
                            const nextDay = new Date(selectedDates[0]);
                            nextDay.setDate(nextDay.getDate() + 1);
                            checkoutPicker.set('minDate', nextDay);
                            // Wyczyść pole checkout jeśli zawiera starą datę
                            if (checkoutPicker.selectedDates.length > 0 && checkoutPicker.selectedDates[0] <= selectedDates[0]) {
                                checkoutPicker.clear();
                            }
                        }
                    }
                });

                checkoutPicker = flatpickr('#checkout', {
                    locale: 'pl',
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    disable: bookedDates
                });
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Kalendarz FullCalendar
        const bookingForm = document.getElementById('bookingForm');
        const submitButton = bookingForm ? bookingForm.querySelector('button[type="submit"]') : null;
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // Załaduj kalendarz i datepickery przy załadowaniu strony
        refreshCalendarAndDatePickers();

        if (bookingForm) {
            bookingForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                if (!csrfToken) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Błąd konfiguracji',
                        text: 'Brak tokena bezpieczeństwa CSRF. Odśwież stronę i spróbuj ponownie.'
                    });
                    return;
                }

                const formData = new FormData(bookingForm);

                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Wysyłanie...';
                }

                try {
                    const response = await fetch('/api/bookings', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        const validationErrors = data?.errors ? Object.values(data.errors).flat() : [];
                        const errorMessage = validationErrors.length > 0
                            ? validationErrors.join('<br>')
                            : (data?.message || 'Nie udało się zapisać rezerwacji.');

                        Swal.fire({
                            icon: 'error',
                            title: 'Nie udało się wysłać rezerwacji',
                            html: errorMessage,
                        });

                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Dziękujemy!',
                        text: data.message || 'Rezerwacja została przyjęta.',
                    });

                    bookingForm.reset();
                    // Odśwież kalendarz po pomyślnej rezerwacji
                    refreshCalendarAndDatePickers();
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Błąd połączenia',
                        text: 'Nie udało się wysłać formularza. Sprawdź połączenie i spróbuj ponownie.'
                    });
                } finally {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Zarezerwuj';
                    }
                }
            });
        }
    });
</script>
@endsection