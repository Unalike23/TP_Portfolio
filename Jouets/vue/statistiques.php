    <div class="section">
        <h2>Statistiques des catalogues</h2>
        <?php foreach ($stats as $catalogueId => $stat): ?>
            <h3>Catalogue <?= $stat['annee'] ?></h3>
            <p><strong>Quantité distribuée totale :</strong> <?= $stat['quantite_distribuee'] ?></p>
            <h4>Statistiques par catégorie :</h4>
            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stat['stat_categ'] as $categorie => $quantite): ?>
                        <tr>
                            <td><?= $categorie ?></td>
                            <td><?= $quantite ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>