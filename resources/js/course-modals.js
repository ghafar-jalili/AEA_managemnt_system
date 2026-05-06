/**
 * Course listing modals (public courses index) — keeps Blade free of large inline scripts.
 */
function coursesBaseUrl() {
    return document.body?.dataset?.coursesBase?.replace(/\/$/, '') || '';
}

window.openWantToStartModal = function openWantToStartModal(courseName) {
    const nameEl = document.getElementById('wantToStartCourseName');
    const inputEl = document.getElementById('wantToStartCourseNameInput');
    const modal = document.getElementById('wantToStartModal');
    if (nameEl) {
        nameEl.textContent = courseName;
    }
    if (inputEl) {
        inputEl.value = courseName;
    }
    modal?.classList.remove('hidden');
};

window.closeWantToStartModal = function closeWantToStartModal() {
    document.getElementById('wantToStartModal')?.classList.add('hidden');
};

window.openAddStudentModal = function openAddStudentModal(courseName) {
    const nameEl = document.getElementById('addStudentCourseName');
    const inputEl = document.getElementById('addStudentCourseNameInput');
    const modal = document.getElementById('addStudentModal');
    if (nameEl) {
        nameEl.textContent = courseName;
    }
    if (inputEl) {
        inputEl.value = courseName;
    }
    modal?.classList.remove('hidden');
};

window.closeAddStudentModal = function closeAddStudentModal() {
    document.getElementById('addStudentModal')?.classList.add('hidden');
};

window.openStudentListModal = function openStudentListModal(courseId, courseTitle) {
    const titleEl = document.getElementById('studentListModalTitle');
    const modal = document.getElementById('studentListModal');
    if (titleEl) {
        titleEl.textContent = `Students — ${courseTitle}`;
    }
    modal?.classList.remove('hidden');
    window.loadStudents?.(courseId);
};

window.closeStudentListModal = function closeStudentListModal() {
    document.getElementById('studentListModal')?.classList.add('hidden');
};

window.loadStudents = function loadStudents(courseId) {
    const contentDiv = document.getElementById('studentListContent');
    if (!contentDiv) {
        return;
    }

    const spinner =
        '<div class="flex justify-center py-8" role="status"><svg class="animate-spin h-8 w-8 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';
    contentDiv.innerHTML = spinner;

    const url = `${coursesBaseUrl()}/${courseId}/students`;

    fetch(url, {
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.students && data.students.length > 0) {
                let html =
                    '<table class="min-w-full divide-y divide-slate-200"><thead class="bg-slate-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Enrolled Date</th></tr></thead><tbody class="bg-white divide-y divide-slate-200">';
                data.students.forEach((student) => {
                    let statusBadge = '';
                    if (student.status === 'approved' || student.status === 'completed') {
                        statusBadge = `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">${student.status}</span>`;
                    } else if (student.status === 'pending') {
                        statusBadge = `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">${student.status}</span>`;
                    } else {
                        statusBadge = `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">${student.status}</span>`;
                    }
                    html += `<tr><td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">${student.name}</td><td class="px-6 py-4 whitespace-nowrap text-sm">${statusBadge}</td><td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${student.enrolled_at}</td></tr>`;
                });
                html += '</tbody></table>';
                contentDiv.innerHTML = html;
            } else {
                contentDiv.innerHTML =
                    '<div class="text-center py-8 text-slate-500">No students enrolled in this course yet.</div>';
            }
        })
        .catch(() => {
            contentDiv.innerHTML =
                '<div class="text-center py-8 text-red-600">Error loading students. Please try again.</div>';
        });
};
