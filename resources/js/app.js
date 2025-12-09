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

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    document.querySelectorAll('[data-toggle="sidebar"]').forEach((btn) => {
        btn.addEventListener('click', () => sidebar?.classList.toggle('-translate-x-full'));
    });

    initCharts(parseDashboardData());

    const toastRoot = document.getElementById('toast-root');
    const flash = toastRoot?.dataset.flash;
    if (flash) {
        const toast = document.createElement('div');
        toast.className =
            'fixed bottom-6 right-6 z-50 flex items-start gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-white shadow-2xl backdrop-blur-md ring-1 ring-white/10 max-w-sm';
        toast.innerHTML = `
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-emerald-500 text-white shadow-md">✓</span>
            <div class="flex-1">
                <p class="font-semibold">Updated</p>
                <p class="text-slate-200">${flash}</p>
            </div>
            <button aria-label="Close toast" class="text-slate-300 hover:text-white">&times;</button>
        `;
        document.body.appendChild(toast);
        const close = toast.querySelector('button');
        close?.addEventListener('click', () => toast.remove());
        setTimeout(() => toast.remove(), 4500);
    }
});
