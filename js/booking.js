/* ── Booking Page JS ─────────────────────────────────── */

document.addEventListener('DOMContentLoaded', function () {

  var params     = new URLSearchParams(window.location.search);
  var serviceId  = params.get('service_id') || '';
  var placeName  = decodeURIComponent(params.get('place') || '');
  var serviceType = decodeURIComponent(params.get('type') || '');
  var price      = parseFloat(params.get('price') || '0');

  /* Fill hidden input */
  var serviceInput = document.getElementById('service_id');
  if (serviceInput && serviceId) {
    serviceInput.value = serviceId;
  }

  /* Show selected service summary */
  if (serviceId && placeName) {
    var summary = document.getElementById('serviceSummary');
    if (summary) {
      document.getElementById('sumPlace').textContent = placeName;
      document.getElementById('sumType').textContent  = serviceType;
      document.getElementById('sumPrice').textContent = price ? '$' + price.toFixed(2) : '—';
      summary.style.display = 'block';
    }
  }

  /* Restrict date to today / tomorrow */
  var dateInput = document.getElementById('date');
  if (dateInput) {
    var today    = new Date();
    var tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    var fmt = function(d) { return d.toISOString().split('T')[0]; };
    dateInput.min   = fmt(today);
    dateInput.max   = fmt(tomorrow);
    dateInput.value = fmt(today);
  }

  /* Show error from URL params */
  var alertEl = document.getElementById('alert');
  var errMsg  = params.get('error');
  if (alertEl && errMsg) {
    alertEl.textContent   = decodeURIComponent(errMsg);
    alertEl.className     = 'alert error';
    alertEl.style.display = 'block';
  }

  /* Client-side validation */
  var form = document.getElementById('bookingForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      var valid    = true;
      var dateErr  = document.getElementById('dateErr');
      var timeErr  = document.getElementById('timeErr');
      var timeSelect = document.getElementById('time_slot');

      if (dateErr) dateErr.textContent = '';
      if (timeErr) timeErr.textContent = '';

      if (serviceInput && !serviceInput.value) {
        alert('No service selected. Please go back and choose a service.');
        e.preventDefault();
        return;
      }

      if (!dateInput || !dateInput.value) {
        if (dateErr) dateErr.textContent = 'Please select a date.';
        if (dateInput) dateInput.classList.add('invalid');
        valid = false;
      }

      if (!timeSelect || !timeSelect.value) {
        if (timeErr) timeErr.textContent = 'Please select a time slot.';
        if (timeSelect) timeSelect.classList.add('invalid');
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
  }

});
