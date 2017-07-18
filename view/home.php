<div class="container">
  <?php foreach ($sessionLocation as $valueLocation ) : ?>
  <h2><?= $valueLocation['loc_name'] ?></h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>nom session</th>
        <th>nr session</th>
        <th>date begin</th>
        <th>date end</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($sessionHome[$valueLocation['loc_id']] as $infoSession ) : ?>
        <tr>
          <td><?= $infoSession['nom_session'] ?></td>
          <td><?= $infoSession['nr_session'] ?></td>
          <td><?= $infoSession['date_begin'] ?></td>
          <td><?= $infoSession['date_end'] ?></td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
  <?php endforeach; ?>
</div>
