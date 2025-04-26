document.addEventListener('DOMContentLoaded', function () {
  const printBtn = document.getElementById('printReportBtn');
  if (printBtn) {
    printBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const reportTable = document.getElementById('reportTable');
      if (reportTable) {
        const printWindow = window.open('', '', 'height=600,width=900');
        printWindow.document.writeln('<html><head><title>Report</title>');
        printWindow.document.writeln(
          '<style>table{border-collapse:collapse;width:100%;}th,td{border:1px solid #333;padding:8px;text-align:left;} h3{text-align:center;}</style>'
        );
        printWindow.document.writeln('</head><body>');
        printWindow.document.writeln('<h3>Report Results</h3>');
        printWindow.document.writeln(reportTable.outerHTML);
        printWindow.document.writeln('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
      }
    });
  }

  // Prevent end date before start date
  const startDateInput = document.getElementById('startDate');
  const endDateInput = document.getElementById('endDate');
  if (startDateInput && endDateInput) {
    function validateDateOrder() {
      const start = new Date(startDateInput.value);
      const end = new Date(endDateInput.value);
      if (startDateInput.value && endDateInput.value && end < start) {
        endDateInput.setCustomValidity(
          'End date must be after or equal to start date'
        );
      } else {
        endDateInput.setCustomValidity('');
      }
    }
    startDateInput.addEventListener('change', validateDateOrder);
    endDateInput.addEventListener('change', validateDateOrder);
  }

  // Clear report table if no data is passed (after form submit with no results)
  const reportForm = document.getElementById('reportForm');
  if (reportForm) {
    reportForm.addEventListener('submit', function () {
      const reportResults = document.getElementById('reportResults');
      if (reportResults) {
        reportResults.innerHTML = '';
      }
    });
  }
});
