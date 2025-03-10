
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Fiche d'appel</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
<h1 class="text-2xl font-bold mb-6">Fiche d'appel</h1>
<div id="students-list" class="space-y-4">
<!-- Liste des élèves sera générée dynamiquement -->
</div>
</div>
 
    <script>

        // Données des élèves (simulées)

        const students = [

            { 

                id: 1, 

                firstName: 'Marie', 

                lastName: 'Dupont', 

                photoUrl: '/api/placeholder/100/100' 

            },

            { 

                id: 2, 

                firstName: 'Jean', 

                lastName: 'Dubois', 

                photoUrl: '/api/placeholder/100/100' 

            },

            { 

                id: 3, 

                firstName: 'Sophie', 

                lastName: 'Martin', 

                photoUrl: '/api/placeholder/100/100' 

            }

        ];
 
        const transportOptions = [

            'Voiture',

            'Bus', 

            'Vélo', 

            'À pied'

        ];
 
        function renderStudentsList() {

            const studentsListContainer = document.getElementById('students-list');

            students.forEach(student => {

                const studentCard = document.createElement('div');

                studentCard.className = 'flex items-center gap-4 p-4 border rounded-lg';

                // Photo et nom de l'élève

                studentCard.innerHTML = `
<img src="${student.photoUrl}" alt="${student.firstName} ${student.lastName}" 

                         class="w-16 h-16 rounded-full object-cover">
<div class="flex-1">
<h2 class="font-semibold">${student.firstName} ${student.lastName}</h2>
<div class="flex items-center gap-4 mt-2">
<label class="flex items-center gap-2">
<input type="checkbox" 

                                       name="presence-${student.id}" 

                                       class="presence-checkbox" 

                                       data-student-id="${student.id}"

                                       checked>

                                Présent
</label>
<select 

                                name="transport-${student.id}" 

                                class="transport-select border rounded px-2 py-1"

                                data-student-id="${student.id}">

                                ${transportOptions.map(option => 

                                    `<option value="${option}">${option}</option>`

                                ).join('')}
</select>
</div>
</div>

                `;

                studentsListContainer.appendChild(studentCard);

            });
 
            // Gestion dynamique de la présence et du transport

            setupEventListeners();

        }
 
        function setupEventListeners() {

            const presenceCheckboxes = document.querySelectorAll('.presence-checkbox');

            const transportSelects = document.querySelectorAll('.transport-select');
 
            presenceCheckboxes.forEach(checkbox => {

                checkbox.addEventListener('change', function() {

                    const studentId = this.dataset.studentId;

                    const transportSelect = document.querySelector(

                        `.transport-select[data-student-id="${studentId}"]`

                    );

                    transportSelect.disabled = !this.checked;

                    if (!this.checked) {

                        transportSelect.selectedIndex = 0;

                    }

                });

            });

        }
 
        // Initialisation

        document.addEventListener('DOMContentLoaded', renderStudentsList);
</script>
</body>
</html>

 