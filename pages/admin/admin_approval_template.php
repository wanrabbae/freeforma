<!-- Koneksi -->
<?php
include '../koneksi.php';

if (isset($_POST['approveTemplate'])) {
  $templateId = $_POST['templateId'];
  $sql = "UPDATE Template SET approvalStatus='accepted' WHERE id='$templateId'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil disetujui!');window.location.href='admin_approval_template.php?title=Approval Template';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal menyetujui template.');</script>";
  }
}

if (isset($_POST['rejectTemplate'])) {
  $templateId = $_POST['templateId'];
  $sql = "UPDATE Template SET approvalStatus='rejected' WHERE id='$templateId'";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Template berhasil ditolak!');window.location.href='admin_approval_template.php?title=Approval Template';</script>";
    exit();
  } else {
    echo "<script>alert('Gagal menolak template.');</script>";
  }
}

?>

<!-- Navbar -->
<?php include './components/header.php'; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Approval Templates</h2>
  </div>
  <div class="table-responsive">
    <table id="templateTable" class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Cover Image</th>
          <th>Template Name</th>
          <th>Author</th>
          <th>Approval Status</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT t.*, u.fullname AS author 
            FROM Template t 
            LEFT JOIN User u ON t.author = u.id 
            WHERE t.approvalStatus = 'pending'
            ORDER BY t.createdAt DESC";
        $result = mysqli_query($koneksi, $sql);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $no++ . '</td>';
          echo '<td><img src="../../templates/covers/' . htmlspecialchars($row['coverImage']) . '" alt="Cover" style="width:60px;height:60px;object-fit:cover;"></td>';
          echo '<td>' . htmlspecialchars($row['templateName']) . '</td>';
          echo '<td>' . htmlspecialchars($row['author']) . '</td>';
          echo '<td> <span class="badge bg-' . ($row['approvalStatus'] == 'pending' ? 'warning text-dark' : ($row['approvalStatus'] == 'accepted' ? 'success' : 'danger')) . '">' . htmlspecialchars(ucfirst($row['approvalStatus'])) . '</span></td>';
          echo '<td>' . htmlspecialchars(date('d M Y', strtotime($row['createdAt']))) . '</td>';
          echo '<td>
            <a href="../download-template.php?id=' . $row['id'] . '" class="btn btn-info btn-sm ">Download</a>
            <form method="post" action="" class="d-inline">
              <input type="hidden" name="templateId" value="' . $row['id'] . '">
              <button type="submit" name="approveTemplate" class="btn btn-success btn-sm" onclick="return confirm(\'Apakah anda yaking ingin acc template ini?\')">Approve</button>
            </form>
            <form method="post" action="" class="d-inline">
              <input type="hidden" name="templateId" value="' . $row['id'] . '">
              <button type="submit" name="rejectTemplate" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yaking ingin menolak template ini?\')">Reject</button>
            </form>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal' . $row['id'] . '">Detail</button>
            
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
                    <p><strong>Approval Status:</strong> ' . htmlspecialchars($row['approvalStatus']) . '</p>
                    <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                    <p><strong>Aktif:</strong> ' . ($row['isActive'] ? 'Aktif' : 'Tidak Aktif') . '</p>
                    <p><strong>Like Count:</strong> ' . (int)$row['likeCount'] . '</p>
                    <p><strong>Download Count:</strong> ' . (int)$row['downloadCount'] . '</p>
                    <p><strong>Created At:</strong> ' . htmlspecialchars($row['createdAt']) . '</p>
                    <p><strong>Description:</strong> <hr>' . $row['deskripsi'] . '</p>
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