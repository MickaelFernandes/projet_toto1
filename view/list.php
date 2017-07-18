<style media="screen">
  #leftb{
    margin-left: 85%;
    margin-right: 10px;
    /*margin-bottom: 5px;*/
  };
</style>


  <div class="container">
    <h2>Infos</h2>
    <?php if (isset($studentListe) && sizeof($studentListe) > 0) : ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>email</th>
            <th>birthdate</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($studentListe as $currentEtudiant) : ?>
            <tr>
              <td><?= $currentEtudiant['stu_lname'] ?></td>
              <td><?= $currentEtudiant['stu_fname'] ?></td>
              <td><?= $currentEtudiant['stu_email'] ?></td>
              <td><?= $currentEtudiant['birthdate'] ?></td>
              <td><a href="student.php?id=<?= $currentEtudiant['stu_id'] ?>"  class="btn btn-success btn-sm">GO!</a></td>
            </tr>
          <?php endforeach; ?>
          <div class="buttons" style="margin-bottom: 15px;">
            <a class="btn btn-success" href="?page=<?= $page - 1?>" role="button" id="leftb" >Previous</a>
            <a class="btn btn-success" href="?page=<?= $page + 1?>" role="button">Next</a>
          </div>
        </tbody>
      </table>
    <?php else :?>
      aucun étudiant
    <?php endif; ?>
  </div>
</body>
