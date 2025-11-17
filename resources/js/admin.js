// Admin-specific JavaScript (initializes Chart.js)
// Use global Chart provided by CDN when Chart.js isn't bundled via npm.

document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("activityChart");
    if (!canvas) return;

    try {
        const labels = JSON.parse(canvas.dataset.labels || "[]");
        const lettersData = JSON.parse(canvas.dataset.letters || "[]");
        const reportsData = JSON.parse(canvas.dataset.reports || "[]");

        const ChartLib = window.Chart || null;
        if (!ChartLib) {
            console.warn("Chart.js not available");
            return;
        }

        const ctx = canvas.getContext("2d");
        // eslint-disable-next-line no-unused-vars
        const activityChart = new ChartLib(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Letters",
                        data: lettersData,
                        backgroundColor: "rgba(59,130,246,0.9)", // blue
                    },
                    {
                        label: "Reports",
                        data: reportsData,
                        backgroundColor: "rgba(37,99,235,0.9)", // darker blue
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: { legend: { position: "top" } },
                scales: { y: { beginAtZero: true } },
            },
        });
    } catch (e) {
        // If parsing fails, do nothing but keep console info for debugging
        // eslint-disable-next-line no-console
        console.error("Failed to initialize admin chart", e);
    }
});
