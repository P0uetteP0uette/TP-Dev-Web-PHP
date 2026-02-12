/* ===============================================================
   1. GESTION DU MENU MOBILE
   =============================================================== */
document.addEventListener('DOMContentLoaded', () => {
    
    // On cible les éléments
    const menuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.querySelector('.sidebar');
    
    // Si les éléments existent sur la page (sécurité)
    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', () => {
            // On ajoute/enlève la classe 'open' définie dans le CSS
            sidebar.classList.toggle('open');
        });

        // Fermer le menu si on clique en dehors
        document.addEventListener('click', (event) => {
            if (!sidebar.contains(event.target) && !menuBtn.contains(event.target) && sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
            }
        });
    }

    /* ===============================================================
       2. SYSTÈME DE NOTIFICATIONS (Toast)
       =============================================================== */
    // Fonction réutilisable pour afficher un message
    window.showNotification = function(message, type = 'success') {
        // Création de la div
        const notification = document.createElement('div');
        notification.className = `notification ${type}`; // ex: notification success
        notification.innerText = message;

        // Style
        Object.assign(notification.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '15px 25px',
            borderRadius: '5px',
            color: 'white',
            fontWeight: 'bold',
            zIndex: '9999',
            boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
            opacity: '0',
            transition: 'opacity 0.5s ease',
            backgroundColor: type === 'success' ? '#22c55e' : '#ef4444' // Vert ou Rouge
        });

        // Ajout au corps de la page
        document.body.appendChild(notification);

        // Animation d'apparition
        setTimeout(() => { notification.style.opacity = '1'; }, 10);

        // Disparition automatique après 3 secondes
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => { notification.remove(); }, 500); // Supprime du DOM
        }, 3000);
    };

    /* ===============================================================
       3. FILTRES DES TICKETS (Page tickets.html)
       =============================================================== */
    const filterButtons = document.querySelectorAll('.filter-btn');
    const ticketRows = document.querySelectorAll('tbody tr'); // Toutes les lignes du tableau

    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // 1. Gérer la classe active sur les boutons (visuel)
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // 2. Récupérer le filtre cliqué (ex: 'all', 'facturable', 'inclus')
                const filterValue = button.getAttribute('data-filter');

                // 3. Boucler sur chaque ligne du tableau
                ticketRows.forEach(row => {
                    // On récupère le type du ticket via un attribut data-type
                    const rowType = row.getAttribute('data-type');

                    if (filterValue === 'all' || rowType === filterValue) {
                        row.style.display = ''; // Affiche la ligne (valeur par défaut)
                    } else {
                        row.style.display = 'none'; // Cache la ligne
                    }
                });
            });
        });
    }

    /* ===============================================================
       4. VALIDATION FORMULAIRE (Page ticket-create.html)
       =============================================================== */
    const ticketForm = document.getElementById('createTicketForm');

    if (ticketForm) {
        ticketForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Empêche le rechargement de la page

            let isValid = true;
            
            // Récupération des champs
            const titleInput = document.getElementById('title');
            const projectSelect = document.getElementById('project');
            const descriptionInput = document.getElementById('description');

            // --- Règle 1 : Le titre doit faire au moins 5 caractères
            if (titleInput.value.trim().length < 5) {
                showNotification("Le sujet est trop court (min 5 caractères)", "error");
                titleInput.style.borderColor = "red";
                isValid = false;
            } else {
                titleInput.style.borderColor = "#ccc"; // Remet en gris si c'est bon
            }

            // --- Règle 2 : Un projet doit être sélectionné
            if (projectSelect.value === "") {
                if(isValid) showNotification("Veuillez sélectionner un projet", "error"); // Affiche l'erreur seulement si la précédente n'a pas déjà été affiché
                projectSelect.style.borderColor = "red";
                isValid = false;
            } else {
                projectSelect.style.borderColor = "#ccc";
            }

            // --- Si tout est bon
            if (isValid) {
                showNotification("Ticket créé avec succès !", "success");
                ticketForm.reset(); // Vide le formulaire
                
                // Simulation d'une redirection après 1.5 secondes
                setTimeout(() => {
                    window.location.href = 'tickets.html';
                }, 1500);
            }
        });
    }

    /* ===============================================================
       5. FILTRES DES PROJETS (Page projects.html)
       =============================================================== */
    // On utilise une classe différente (.project-filter-btn) pour ne pas mélanger avec les tickets
    const projectFilterButtons = document.querySelectorAll('.project-filter-btn');
    const projectRows = document.querySelectorAll('tbody tr'); // Toutes les lignes

    if (projectFilterButtons.length > 0) {
        projectFilterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // 1. Visuel bouton actif
                projectFilterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // 2. Récupérer la valeur (all, actif, epuise)
                const filterValue = button.getAttribute('data-filter');

                // 3. Filtrer les lignes
                projectRows.forEach(row => {
                    const status = row.getAttribute('data-status'); // On lit l'attribut HTML

                    if (filterValue === 'all' || status === filterValue) {
                        row.style.display = ''; 
                    } else {
                        row.style.display = 'none'; 
                    }
                });
            });
        });
    }

    /* ===============================================================
       6. VALIDATION CRÉATION PROJET (Page project-create.html)
       =============================================================== */
    const projectForm = document.getElementById('createProjectForm');

    if (projectForm) {
        projectForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Stop l'envoi

            let isValid = true;

            // Récupération des champs
            const nameInput = document.getElementById('name');
            const clientSelect = document.getElementById('client');
            const hoursInput = document.getElementById('hours');
            const rateInput = document.getElementById('rate');

            // 1. Nom du projet (min 3 caractères)
            if (nameInput.value.trim().length < 3) {
                showNotification("Le nom du projet est trop court (min 3 caractères)", "error");
                nameInput.style.borderColor = "red";
                isValid = false;
            } else {
                nameInput.style.borderColor = "#ccc";
            }

            // 2. Client obligatoire
            if (clientSelect.value === "") {
                if(isValid) showNotification("Veuillez choisir un client", "error");
                clientSelect.style.borderColor = "red";
                isValid = false;
            } else {
                clientSelect.style.borderColor = "#ccc";
            }

            // 3. Heures et Taux (Doivent être positifs)
            if (hoursInput.value <= 0 || rateInput.value <= 0) {
                if(isValid) showNotification("Les heures et le taux doivent être positifs", "error");
                hoursInput.style.borderColor = "red";
                rateInput.style.borderColor = "red";
                isValid = false;
            } else {
                hoursInput.style.borderColor = "#ccc";
                rateInput.style.borderColor = "#ccc";
            }

            // Succès
            if (isValid) {
                showNotification("Projet créé avec succès !", "success");
                projectForm.reset();
                setTimeout(() => {
                    window.location.href = 'projects.html';
                }, 1500);
            }
        });
    }

});