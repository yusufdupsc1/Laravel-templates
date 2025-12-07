import './bootstrap';
import Chart from 'chart.js/auto';

const parseDashboardData = () => {
    const el = document.getElementById('dashboard-data');
    if (!el) return null;
    try {
        return JSON.parse(el.textContent || '{}');
    } catch (error) {
        console.warn('Unable to parse dashboard data', error);
        return null;
    }
};

const initCharts = (data) => {
    if (!data) return;

    const attendanceCtx = document.getElementById('attendanceChart');
    if (attendanceCtx && data.attendanceTrend) {
        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: data.attendanceTrend.labels,
                datasets: [
                    {
                        label: 'Attendance',
                        data: data.attendanceTrend.values,
                        borderColor: '#22d3ee',
                        backgroundColor: 'rgba(34, 211, 238, 0.12)',
                        tension: 0.45,
                        borderWidth: 3,
                        pointBackgroundColor: '#34d399',
                        pointRadius: 4,
                    },
                ],
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { suggestedMin: 80, suggestedMax: 100, ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(255,255,255,0.05)' } },
                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                },
            },
        });
    }

    const feesCtx = document.getElementById('feesChart');
    if (feesCtx && data.feesStatus) {
        new Chart(feesCtx, {
            type: 'doughnut',
            data: {
                labels: data.feesStatus.labels,
                datasets: [
                    {
                        data: data.feesStatus.values,
                        backgroundColor: ['#22c55e', '#0ea5e9', '#f59e0b'],
                        borderWidth: 0,
                    },
                ],
            },
            options: {
                plugins: { legend: { labels: { color: '#cbd5e1' } } },
                cutout: '70%',
            },
        });
    }

    const gradeCtx = document.getElementById('gradeChart');
    if (gradeCtx && data.gradeDistribution) {
        new Chart(gradeCtx, {
            type: 'bar',
            data: {
                labels: data.gradeDistribution.labels,
                datasets: [
                    {
                        data: data.gradeDistribution.values,
                        backgroundColor: ['#38bdf8', '#22c55e', '#a855f7', '#f59e0b', '#ef4444'],
                        borderRadius: 6,
                        borderSkipped: false,
                    },
                ],
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    y: { ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(255,255,255,0.05)' } },
                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                },
            },
        });
    }
};

const initToggles = () => {
    const sidebar = document.getElementById('sidebar');
    const toggles = document.querySelectorAll('[data-toggle="sidebar"]');
    toggles.forEach((btn) => {
        btn.addEventListener('click', () => {
            sidebar?.classList.toggle('-translate-x-full');
        });
    });

    document.addEventListener('keydown', (event) => {
        if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
            const input = document.querySelector('[data-input="command-k"]');
            input?.focus();
            event.preventDefault();
        }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    initToggles();
    initCharts(parseDashboardData());
});
