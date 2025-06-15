<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

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
          echo '<td>' . htmlspecialchars($row['approvalStatus']) . '</td>';
          echo '<td>' . htmlspecialchars(date('d M Y', strtotime($row['createdAt']))) . '</td>';
          echo '<td>
            <a href="../download-template.php?id=' . $row['id'] . '" class="btn btn-info btn-sm ">Download</a>
            <a href="delete_template.php?id=' . $row['id'] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Are you sure you want to approve this template?\')">Approve</a>
            <a href="delete_template.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to reject this template?\')">Reject</a>
            <button class="btn btn-warning text-dark btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal' . $row['id'] . '">Detail</button>
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