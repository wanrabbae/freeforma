<!-- Koneksi -->
<?php include '../koneksi.php'; ?>

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
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT t.*, u.fullname AS author 
            FROM Template t 
            LEFT JOIN User u ON t.author = u.id 
            ORDER BY t.createdAt DESC";
        $result = mysqli_query($koneksi, $sql);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $no++ . '</td>';
          echo '<td><img src="' . htmlspecialchars($row['coverImage']) . '" alt="Cover" style="width:60px;height:60px;object-fit:cover;"></td>';
          echo '<td>' . htmlspecialchars($row['templateName']) . '</td>';
          echo '<td>' . htmlspecialchars($row['author']) . '</td>';
          echo '<td>' . (int)$row['likeCount'] . '</td>';
          echo '<td>' . (int)$row['downloadCount'] . '</td>';
          echo '<td>' . htmlspecialchars($row['createdAt']) . '</td>';
          // Action buttons for download, detail, and delete, and modal details
          echo '<td>
            <a href="download_template.php?id=' . $row['id'] . '" class="btn btn-info btn-sm mb-1">Download</a>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#templateModal' . $row['id'] . '">Detail</button>
            <a href="delete_template.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this template?\')">Delete</a>
            <div class="modal fade" id="templateModal' . $row['id'] . '" tabindex="-1" aria-labelledby="templateModalLabel' . $row['id'] . '" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel' . $row['id'] . '">' . htmlspecialchars($row['templateName']) . '</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <img src="' . htmlspecialchars($row['coverImage']) . '" alt="Cover" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
                    <p><strong>Author:</strong> ' . htmlspecialchars($row['author']) . '</p>
                    <p><strong>Like Count:</strong> ' . (int)$row['likeCount'] . '</p>
                    <p><strong>Download Count:</strong> ' . (int)$row['downloadCount'] . '</p>
                    <p><strong>Created At:</strong> ' . htmlspecialchars($row['createdAt']) . '</p>
                    <p><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="download_template.php?id=' . $row['id'] . '" class="btn btn-primary">Download Template</a>
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