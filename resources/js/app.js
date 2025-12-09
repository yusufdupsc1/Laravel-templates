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

    const lineCtx = document.getElementById('attendanceChart');
    if (lineCtx && data.line) {
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: data.line.labels,
                datasets: data.line.datasets.map((d, idx) => ({
                    ...d,
                    borderColor: idx === 0 ? '#0ea5e9' : '#f97316',
                    backgroundColor: idx === 0 ? 'rgba(14,165,233,0.1)' : 'rgba(249,115,22,0.1)',
                    tension: 0.35,
                    borderWidth: 3,
                    pointRadius: 3,
                })),
            },
            options: {
                plugins: { legend: { labels: { color: '#334155' } } },
                scales: {
                    y: { ticks: { color: '#64748b' }, grid: { color: 'rgba(100,116,139,0.12)' } },
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
                plugins: { legend: { labels: { color: '#334155' } } },
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
                    y: { ticks: { color: '#64748b' }, grid: { color: 'rgba(100,116,139,0.12)' } },
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
            'fixed bottom-6 right-6 z-50 flex items-start gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-2xl backdrop-blur-md ring-1 ring-slate-100 max-w-sm';
        toast.innerHTML = `
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-indigo-500 text-white shadow-md">✓</span>
            <div class="flex-1">
                <p class="font-semibold">Updated</p>
                <p class="text-slate-600">${flash}</p>
            </div>
            <button aria-label="Close toast" class="text-slate-400 hover:text-slate-900">&times;</button>
        `;
        document.body.appendChild(toast);
        const close = toast.querySelector('button');
        close?.addEventListener('click', () => toast.remove());
        setTimeout(() => toast.remove(), 4500);
    }

    // Quick find palette
    const quickFind = document.getElementById('quick-find');
    const quickFindInput = document.getElementById('quick-find-input');
    const quickFindItems = Array.from(document.querySelectorAll('.quick-find-item'));

    const openQuickFind = () => {
        if (!quickFind) return;
        quickFind.classList.remove('hidden');
        quickFindInput?.focus();
    };

    const closeQuickFind = () => {
        if (!quickFind) return;
        quickFind.classList.add('hidden');
        quickFindInput.value = '';
        quickFindItems.forEach((item) => (item.style.display = 'flex'));
    };

    document.querySelectorAll('[data-open="quick-find"]').forEach((btn) =>
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openQuickFind();
        })
    );

    document.querySelectorAll('[data-close="quick-find"]').forEach((btn) =>
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeQuickFind();
        })
    );

    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            openQuickFind();
        }
        if (e.key === 'Escape') {
            closeQuickFind();
        }
    });

    quickFind?.addEventListener('click', (e) => {
        if (e.target === quickFind) {
            closeQuickFind();
        }
    });

    quickFindInput?.addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase();
        quickFindItems.forEach((item) => {
            const label = item.dataset.label || '';
            item.style.display = label.includes(term) ? 'flex' : 'none';
        });
    });
});
