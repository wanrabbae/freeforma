<!-- Koneksi -->
<?php
include '../koneksi.php';

if (isset($_POST['deleteTemplate'])) {
  $templateId = $_POST['templateId'];
  $sql = "DELETE FROM Template WHERE id='$templateId'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil dihapus!');window.location.href='admin_list_template.php?title=Templates';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal menghapus template.');</script>";
  }
}

?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>List of Templates</h2>
    <a href="admin_approval_template.php?title=Approval Template" class="btn btn-primary">Go to Approval Page</a>
  </div>
  <div class="table-responsive">
    <table id="templateTable" class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Cover Image</th>
          <th>Template Name</th>
          <th>Author</th>
          <th>Like Count</th>
          <th>Download Count</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT t.*, u.fullname AS author 
            FROM Template t 
            LEFT JOIN User u ON t.author = u.id
            -- WHERE t.approvalStatus = 'accepted' 
            ORDER BY t.createdAt DESC";
        $result = mysqli_query($koneksi, $sql);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $no++ . '</td>';
          echo '<td><img src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Cover" style="width:60px;height:60px;object-fit:cover;"></td>';
          echo '<td>' . htmlspecialchars($row['templateName']) . '</td>';
          echo '<td>' . htmlspecialchars($row['author']) . '</td>';
          echo '<td>
            <i class="bi bi-heart"></i>
          ' . (int)$row['likeCount'] . '</td>';
          echo '<td>
            <i class="bi bi-download"></i>
          ' . (int)$row['downloadCount'] . '</td>';
          echo '<td>' . htmlspecialchars(date('d M Y', strtotime($row['createdAt']))) . '</td>';
          echo '<td>
            <button class="btn btn-warning text-dark btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal' . $row['id'] . '">Detail</button>
            <form action="" method="POST" class="d-inline">
              <input type="hidden" name="templateId" value="' . $row['id'] . '">
              <button type="submit" class="btn btn-danger btn-sm" name="deleteTemplate" onclick="return confirm(\'Are you sure you want to delete this template?\')">Delete</button>
            </form>
            <div class="modal fade" id="templateModal' . $row['id'] . '" tabindex="-1" aria-labelledby="templateModalLabel' . $row['id'] . '" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel' . $row['id'] . '">' . htmlspecialchars($row['templateName']) . '</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <img src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Cover" class="img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <p><strong>Author:</strong> ' . htmlspecialchars($row['author']) . '</p>
                    <p><strong>Like Count:</strong> ' . (int)$row['likeCount'] . '</p>
                    <p><strong>Download Count:</strong> ' . (int)$row['downloadCount'] . '</p>
                    <p><strong>Created At:</strong> ' . htmlspecialchars($row['createdAt']) . '</p>
                    <p><strong>Description:</strong> ' . $row['deskripsi'] . '</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="../download-template.php?id=' . $row['id'] . '" class="btn btn-success"><i class="bi bi-download"></i> Download Template</a>
                  </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#templateTable').DataTable();
  });
</script>