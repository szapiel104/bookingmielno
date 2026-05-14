@extends('layouts.app')
@section('title', 'Rezerwacja')
@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Rezerwacja noclegu</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="calendar-container mb-4" id="calendar"></div>
            <div class="mt-3 text-center">
                <span class="me-3"><span style="display: inline-block; width: 15px; height: 15px; background: #7C83FD; margin-right: 5px;"></span>Dostępne</span>
                <span><span style="display: inline-block; width: 15px; height: 15px; background: #FF6A6A; margin-right: 5px;"></span>Zarezerwowane</span>
            </div>
            @include('booking._form')
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kalendarz FullCalendar
        const calendarEl = document.getElementById('calendar');
        const bookingForm = document.getElementById('bookingForm');
        const submitButton = bookingForm ? bookingForm.querySelector('button[type="submit"]') : null;
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
        let bookedDates = [];

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

        fetch('/api/availability')
            .then(response => response.json())
            .then(data => {
                bookedDates = data.booked_dates;
                const calendar = new FullCalendar.Calendar(calendarEl, {
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
                calendar.render();

                // Flatpickr do wyboru dat
                flatpickr('#checkin', {
                    locale: 'pl',
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    disable: bookedDates,
                    onChange: function(selectedDates, dateStr) {
                        checkoutPicker.set('minDate', dateStr);
                    }
                });
                const checkoutPicker = flatpickr('#checkout', {
                    locale: 'pl',
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    disable: bookedDates
                });
            });
    });
</script>
@endsection