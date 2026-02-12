<?php 
$pageTitle = "Détail Ticket - Ticketing App"; 

// 1. MOCKUP DONNÉES (Plus détaillé que dans la liste pour cette vue)
$tickets = [
    [
        "id" => 1,
        "titre" => "Problème d'imprimante",
        "description" => "L'imprimante du 2ème étage ne répond plus. Elle clignote rouge.",
        "statut" => "En cours",
        "priorite" => "Haute",
        "client" => "Acme Corp",
        "projet" => "Maintenance Parc",
        "date_creation" => "12/02/2026",
        "type" => "Inclus", // Pas d'alerte
        "est_facturable" => false,
        "messages" => [
            ["auteur" => "Jean Admin", "date" => "12 Fév. 09:00", "texte" => "C'est urgent, on a une réunion dans 1h !"],
            ["auteur" => "Support Tech", "date" => "12 Fév. 09:15", "texte" => "Reçu. Un technicien arrive."]
        ]
    ],
    [
        "id" => 2, // Celui de ton exemple HTML
        "titre" => "Ajout module export PDF",
        "description" => "Nous aurions besoin d'un bouton sur la page 'Commandes' pour télécharger la facture au format PDF. Le PDF doit contenir notre logo.",
        "statut" => "En attente",
        "priorite" => "Moyenne",
        "client" => "Globex",
        "projet" => "Site E-commerce",
        "date_creation" => "27 Janv. 2026",
        "type" => "Facturable", // Affiche l'alerte orange
        "est_facturable" => true,
        "messages" => [
            ["auteur" => "Jean Dupont", "date" => "27 Janv. 10:00", "texte" => "Avez-vous pu estimer le temps nécessaire ?"],
            ["auteur" => "Admin (Support)", "date" => "27 Janv. 14:30", "texte" => "Oui, 4h de dev. Votre forfait est épuisé, merci de valider le devis."]
        ]
    ],
    [
        "id" => 3,
        "titre" => "Ecran bleu",
        "description" => "Mon PC plante au démarrage avec une erreur MEMORY_MANAGEMENT.",
        "statut" => "Nouveau",
        "priorite" => "Critique",
        "client" => "Wayne Ent.",
        "projet" => "Support IT",
        "date_creation" => "10/02/2026",
        "type" => "Inclus",
        "est_facturable" => false,
        "messages" => []
    ]
];

// 2. RECUPERATION DE L'ID
// Si pas d'ID dans l'URL, on affiche le ticket #2 par défaut (celui de ton exemple)
$ticket_id = $_GET['id'] ?? 2;
$ticket = null;

foreach ($tickets as $t) {
    if ($t['id'] == $ticket_id) {
        $ticket = $t;
        break;
    }
}

if (!$ticket) {
    echo "Ticket introuvable.";
    exit;
}

include 'header.php'; 
?>

<body>

<button id="mobile-menu-btn" class="menu-btn">
    <span>&#8942;</span>
</button>

<div class="app-layout">
    
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php">📊 Tableau de bord</a></li>
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php" class="active">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <div class="page-header-simple">
            <a href="tickets.php" class="link-back">← Retour à la liste</a>
            <div class="header-flex mt-1">
                <h1>#<?php echo $ticket['id']; ?> - <?php echo htmlspecialchars($ticket['titre']); ?></h1>
                
                <?php if($ticket['est_facturable']): ?>
                    <span class="badge badge-red">Facturable</span>
                <?php else: ?>
                    <span class="badge badge-gray">Inclus</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid-2-1">
            
            <section class="col-main">
                
                <div class="card">
                    <h2>Description de la demande</h2>
                    <div class="ticket-description">
                        <p><?php echo nl2br(htmlspecialchars($ticket['description'])); ?></p>
                    </div>
                </div>

                <div class="card">
                    <h2>Historique des échanges</h2>
                    
                    <?php if (!empty($ticket['messages'])): ?>
                        <?php foreach($ticket['messages'] as $msg): ?>
                            <div class="message <?php echo strpos($msg['auteur'], 'Support') !== false ? 'message-support' : ''; ?>">
                                <span class="message-meta"><?php echo htmlspecialchars($msg['auteur']); ?> - <?php echo $msg['date']; ?></span>
                                <p><?php echo htmlspecialchars($msg['texte']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Aucun message pour le moment.</p>
                    <?php endif; ?>

                    <div class="comment-area mt-1">
                        <textarea rows="3" placeholder="Écrire un message..."></textarea>
                        <button class="btn btn-sm mt-1">Envoyer</button>
                    </div>
                </div>
            </section>

            <aside class="col-sidebar">
                
                <?php if ($ticket['est_facturable']): ?>
                <div class="card card-alert-orange">
                    <h2>⚠️ Action requise</h2>
                    <p class="mb-1">Ce ticket est hors forfait. Veuillez valider le devis.</p>
                    <button class="btn bg-green mb-1 w-100">✅ Accepter le devis</button>
                    <button class="btn bg-red w-100">Refuser</button>
                </div>
                <?php endif; ?>

                <div class="card">
                    <h2>Informations</h2>
                    <ul class="info-list">
                        <li>
                            <strong>Statut</strong> 
                            <span class="badge badge-yellow"><?php echo htmlspecialchars($ticket['statut']); ?></span>
                        </li>
                        <li>
                            <strong>Priorité</strong> 
                            <span><?php echo htmlspecialchars($ticket['priorite']); ?></span>
                        </li>
                        <li>
                            <strong>Client</strong> 
                            <span><?php echo htmlspecialchars($ticket['client']); ?></span>
                        </li>
                        <li>
                            <strong>Projet</strong> 
                            <span><?php echo htmlspecialchars($ticket['projet']); ?></span>
                        </li>
                        <li>
                            <strong>Créé le</strong> 
                            <span><?php echo htmlspecialchars($ticket['date_creation']); ?></span>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <h2>Suivi du temps</h2>
                    <ul class="info-list">
                        <li><strong>Estimé</strong> <span>4h 00</span></li>
                        <li><strong>Réel passé</strong> <span>0h 00</span></li>
                        <li><strong>Reste à faire</strong> <span>4h 00</span></li>
                    </ul>
                    <div class="progress-container mt-1">
                        <div class="progress-bar" style="width: 0%;"></div>
                    </div>
                </div>

            </aside>

        </div>
    </main>
<?php include 'footer.php'; ?>