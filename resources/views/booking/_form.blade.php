<form id="bookingForm" class="bg-white p-4 rounded-4 shadow-sm">
    <div class="mb-3">
        <label for="guest_name" class="form-label">Imię i nazwisko</label>
        <input type="text" class="form-control rounded-3" id="guest_name" name="guest_name" required>
    </div>
    <div class="mb-3">
        <label for="guest_email" class="form-label">E-mail</label>
        <input type="email" class="form-control rounded-3" id="guest_email" name="guest_email" required>
    </div>
    <div class="mb-3">
        <label for="guest_phone" class="form-label">Telefon</label>
        <input type="tel" class="form-control rounded-3" id="guest_phone" name="guest_phone" required>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="checkin" class="form-label">Data przyjazdu</label>
            <input type="text" class="form-control rounded-3" id="checkin" name="check_in_date" required>
        </div>
        <div class="col">
            <label for="checkout" class="form-label">Data wyjazdu</label>
            <input type="text" class="form-control rounded-3" id="checkout" name="check_out_date" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="special_requests" class="form-label">Dodatkowe uwagi</label>
        <textarea class="form-control rounded-3" id="special_requests" name="special_requests" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100 rounded-3">Zarezerwuj</button>
</form>