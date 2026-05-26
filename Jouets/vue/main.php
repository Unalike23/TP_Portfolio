    <div class="section">
        <h2>Liste des jouets (Classés par catégories via les Collections)</h2>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Libellé</th>
                    <th>Catégorie</th>
                    <th>Tranche d'Âge</th>
                    <th>Quantité totale prévue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie): ?>
                    <!-- On parcourt la collection (LesJouets) de la catégorie ! -->
                    <?php foreach ($categorie->getLesJouets() as $jouet): ?>
                        <tr>
                            <td><?= htmlspecialchars($jouet->getNumero()) ?></td>
                            <td><?= htmlspecialchars($jouet->getLibelle()) ?></td>
                            <td><strong><?= htmlspecialchars($categorie->getLibelle()) ?></strong></td>
                            <td><?= htmlspecialchars($jouet->getTranche()->getAgeMin()) ?> - <?= htmlspecialchars($jouet->getTranche()->getAgeMax()) ?> ans</td>
                            <td><?= htmlspecialchars($quantiteParJouet[$jouet->getId()] ?? 0) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
