/* ── Listing / Search JS (Student 2) ────────────────────
   Handles:
   - Live search filtering on carwashes PHP page
   - Highlight matched search keyword in results
   - Smooth scroll to results after filter            */

document.addEventListener('DOMContentLoaded', function () {

  /* ── Highlight search keyword in card text ── */
  const urlQ = new URLSearchParams(window.location.search).get('q') || '';
  if (urlQ) {
    const cards = document.querySelectorAll('.card-body h2, .card-desc');
    const regex = new RegExp('(' + escapeRegex(urlQ) + ')', 'gi');
    cards.forEach(function (el) {
      el.innerHTML = el.textContent.replace(
        regex,
        '<mark style="background:#FEF9C3;border-radius:3px;padding:0 2px;">$1</mark>'
      );
    });
  }

  /* ── Auto-submit filter form on select change ── */
  const typeSelect = document.querySelector('.filter-bar select[name="type"]');
  if (typeSelect) {
    typeSelect.addEventListener('change', function () {
      this.closest('form').submit();
    });
  }

  /* ── Count and show result total ── */
  const grid = document.querySelector('.cards-grid');
  if (grid) {
    const count = grid.querySelectorAll('.card').length;
    const header = document.querySelector('.page-header p');
    if (header && count > 0) {
      header.textContent = count + ' car wash location' + (count !== 1 ? 's' : '') + ' available';
    }
  }

  /* ── Utility: escape regex special chars ── */
  function escapeRegex(str) {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
  }

});
