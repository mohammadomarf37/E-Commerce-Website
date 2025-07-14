// assets/adminpanel/dashboard.js
function searchTable(input, tableId) {
  const filter = input.value.toUpperCase();
  const table = document.getElementById(tableId);
  const rows = table.getElementsByTagName("tr");

  for (let i = 1; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName("td");
    let match = false;

    for (let j = 0; j < cells.length; j++) {
      const cellValue = cells[j].innerText || cells[j].textContent;
      if (cellValue.toUpperCase().indexOf(filter) > -1) {
        match = true;
        break;
      }
    }

    rows[i].style.display = match ? "" : "none";
  }
}

// Charts
document.addEventListener('DOMContentLoaded', () => {
  const ctx = document.getElementById('viewsChart');
  if (ctx) {
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Home', 'Shop', 'Login', 'Register', 'Search', 'Product'],
        datasets: [{
          label: 'Page Views',
          data: [120, 200, 80, 60, 110, 150], // dynamic later
          backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
});
