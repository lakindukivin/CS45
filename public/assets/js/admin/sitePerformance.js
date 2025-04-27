document.addEventListener('DOMContentLoaded', function () {
  fetch('http://localhost/CS45/public/SitePerformance/trafficData')
    .then((response) => response.json())
    .then((data) => {
      document.getElementById('total-visits').textContent = data.totalVisits;
      document.getElementById('unique-visitors').textContent =
        data.uniqueVisitors;
      document.getElementById('avg-time').textContent = data.avgTime;

      const ctx = document.getElementById('trafficTrendChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: data.trend.labels,
          datasets: [
            {
              label: 'Visits',
              data: data.trend.data,
              backgroundColor: 'rgba(52, 150, 94, 0.2)',
              borderColor: 'rgba(52, 150, 94, 1)',
              borderWidth: 2,
              pointBackgroundColor: 'rgba(52, 150, 94, 1)',
              tension: 0.3,
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true } },
        },
      });
    })
    .catch(() => {
      document.getElementById('total-visits').textContent = 'Error';
      document.getElementById('unique-visitors').textContent = 'Error';
      document.getElementById('avg-time').textContent = 'Error';
    });
});
