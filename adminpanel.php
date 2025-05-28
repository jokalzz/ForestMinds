<?php 
session_start();

// Cek apakah user sudah login dan merupakan admin
if(!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("php/config.php");

// Handle form submissions
if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'add_video':
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $video_url = '';
            
            // Handle file upload
            if(isset($_FILES['video_file']) && $_FILES['video_file']['error'] == 0) {
                $upload_dir = 'assets/videos/';
                
                // Create directory if not exists
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = $_FILES['video_file']['name'];
                $file_tmp = $_FILES['video_file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Check file type
                $allowed_types = array('mp4', 'avi', 'mov', 'wmv', 'webm');
                if(in_array($file_ext, $allowed_types)) {
                    // Generate unique filename
                    $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
                    $upload_path = $upload_dir . $new_filename;
                    
                    if(move_uploaded_file($file_tmp, $upload_path)) {
                        $video_url = $upload_path;
                    } else {
                        $error_message = "Error uploading file!";
                        break;
                    }
                } else {
                    $error_message = "File type not allowed! Only MP4, AVI, MOV, WMV, WEBM are allowed.";
                    break;
                }
            } else if(isset($_POST['video_url']) && !empty($_POST['video_url'])) {
                // Use URL if provided
                $video_url = mysqli_real_escape_string($con, $_POST['video_url']);
            } else {
                $error_message = "Please upload a video file or provide a video URL!";
                break;
            }
            
            $query = "INSERT INTO videos (title, video_url, description, created_at) VALUES ('$title', '$video_url', '$description', NOW())";
            if(mysqli_query($con, $query)) {
                $success_message = "Video berhasil ditambahkan!";
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
            break;
            
        case 'update_video':
            $id = $_POST['video_id'];
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $video_url = '';
            
            // Handle file upload for update
            if(isset($_FILES['video_file']) && $_FILES['video_file']['error'] == 0) {
                $upload_dir = 'assets/videos/';
                
                // Create directory if not exists
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = $_FILES['video_file']['name'];
                $file_tmp = $_FILES['video_file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Check file type
                $allowed_types = array('mp4', 'avi', 'mov', 'wmv', 'webm');
                if(in_array($file_ext, $allowed_types)) {
                    // Generate unique filename
                    $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
                    $upload_path = $upload_dir . $new_filename;
                    
                    if(move_uploaded_file($file_tmp, $upload_path)) {
                        // Delete old file if exists
                        $old_video = mysqli_fetch_assoc(mysqli_query($con, "SELECT video_url FROM videos WHERE id = $id"));
                        if($old_video && file_exists($old_video['video_url']) && strpos($old_video['video_url'], 'assets/videos/') !== false) {
                            unlink($old_video['video_url']);
                        }
                        $video_url = $upload_path;
                    } else {
                        $error_message = "Error uploading file!";
                        break;
                    }
                } else {
                    $error_message = "File type not allowed! Only MP4, AVI, MOV, WMV, WEBM are allowed.";
                    break;
                }
            } else if(isset($_POST['video_url']) && !empty($_POST['video_url'])) {
                // Use URL if provided
                $video_url = mysqli_real_escape_string($con, $_POST['video_url']);
            } else {
                // Keep existing video if no new upload
                $existing_video = mysqli_fetch_assoc(mysqli_query($con, "SELECT video_url FROM videos WHERE id = $id"));
                $video_url = $existing_video['video_url'];
            }
            
            $query = "UPDATE videos SET title='$title', video_url='$video_url', description='$description' WHERE id=$id";
            if(mysqli_query($con, $query)) {
                $success_message = "Video berhasil diupdate!";
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
            break;
            
        case 'delete_video':
            $id = $_POST['video_id'];
            
            // Get video info to delete file
            $video_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT video_url FROM videos WHERE id = $id"));
            
            // Delete video file if it's uploaded file (not URL)
            if($video_info && file_exists($video_info['video_url']) && strpos($video_info['video_url'], 'assets/videos/') !== false) {
                unlink($video_info['video_url']);
            }
            
            // Hapus komentar terkait video terlebih dahulu
            mysqli_query($con, "DELETE FROM comments WHERE video_id = $id");
            // Kemudian hapus video
            $query = "DELETE FROM videos WHERE id = $id";
            if(mysqli_query($con, $query)) {
                $success_message = "Video, file, dan komentar terkait berhasil dihapus!";
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
            break;
            
        case 'delete_comment':
            $id = $_POST['comment_id'];
            $query = "DELETE FROM comments WHERE id = $id";
            if(mysqli_query($con, $query)) {
                $success_message = "Komentar berhasil dihapus!";
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
            break;
    }
}

// Get statistics
$total_videos = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM videos"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM users"))['count'];
$total_comments = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM comments"))['count'];

// Get videos
$videos_query = "SELECT * FROM videos ORDER BY created_at DESC";
$videos_result = mysqli_query($con, $videos_query);

// Get comments with user and video info
$comments_query = "SELECT c.*, u.Username, v.title as video_title 
                   FROM comments c 
                   JOIN users u ON c.user_id = u.Id 
                   JOIN videos v ON c.video_id = v.id 
                   ORDER BY c.created_at DESC";
$comments_result = mysqli_query($con, $comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header h1 {
            color: white;
            font-size: 1.8rem;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            color: white;
        }
        
        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .tabs {
            display: flex;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.5rem;
        }
        
        .tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .tab-content {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 2rem;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
        }
        
        .file-input {
            background: rgba(255, 255, 255, 0.2) !important;
            border: 2px dashed rgba(255, 255, 255, 0.5) !important;
            padding: 1rem !important;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            border-color: rgba(255, 255, 255, 0.7) !important;
        }
        
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-danger {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        }
        
        .btn-edit {
            background: linear-gradient(45deg, #feca57, #ff9ff3);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .table th, .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .table th {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }
        
        .message {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .success {
            background: rgba(46, 213, 115, 0.2);
            color: #2ed573;
            border: 1px solid #2ed573;
        }
        
        .error {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            color: white;
        }
        
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <?php if(isset($success_message)): ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if(isset($error_message)): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $total_videos; ?></h3>
                <p>Total Videos</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $total_users; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $total_comments; ?></h3>
                <p>Total Comments</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab active" onclick="showTab('videos')">Kelola Video</button>
            <button class="tab" onclick="showTab('comments')">Kelola Komentar</button>
        </div>

        <!-- Video Management Tab -->
        <div id="videos" class="tab-content active">
            <h2 style="color: white; margin-bottom: 1rem;">Tambah Video Baru</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_video">
                <div class="form-group">
                    <label>Judul Video</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Upload Video File</label>
                    <input type="file" name="video_file" accept=".mp4,.avi,.mov,.wmv,.webm" class="file-input">
                    <small style="color: rgba(255,255,255,0.7); display: block; margin-top: 5px;">
                        Format yang didukung: MP4, AVI, MOV, WMV, WEBM (Max: 50MB)
                    </small>
                </div>
                <div class="form-group">
                    <label>ATAU URL Video (Opsional)</label>
                    <input type="url" name="video_url" placeholder="https://example.com/video.mp4">
                    <small style="color: rgba(255,255,255,0.7); display: block; margin-top: 5px;">
                        Jika upload file, URL akan diabaikan
                    </small>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn">Tambah Video</button>
            </form>

            <h2 style="color: white; margin: 2rem 0 1rem 0;">Daftar Video</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>URL</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($video = mysqli_fetch_assoc($videos_result)): ?>
                    <tr>
                        <td><?php echo $video['id']; ?></td>
                        <td><?php echo htmlspecialchars($video['title']); ?></td>
                        <td>
                            <?php if(strpos($video['video_url'], 'http') === 0): ?>
                                <a href="<?php echo $video['video_url']; ?>" target="_blank" style="color: #feca57;">External URL</a>
                            <?php else: ?>
                                <a href="<?php echo $video['video_url']; ?>" target="_blank" style="color: #54a0ff;">Local File</a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo substr(htmlspecialchars($video['description']), 0, 50) . '...'; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($video['created_at'])); ?></td>
                        <td>
                            <button class="btn btn-edit" onclick="editVideo(<?php echo $video['id']; ?>, '<?php echo addslashes($video['title']); ?>', '<?php echo addslashes($video['video_url']); ?>', '<?php echo addslashes($video['description']); ?>')">Edit</button>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                <input type="hidden" name="action" value="delete_video">
                                <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Comments Management Tab -->
        <div id="comments" class="tab-content">
            <h2 style="color: white; margin-bottom: 1rem;">Kelola Komentar</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Video</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($comment = mysqli_fetch_assoc($comments_result)): ?>
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo htmlspecialchars($comment['Username']); ?></td>
                        <td><?php echo htmlspecialchars($comment['video_title']); ?></td>
                        <td><?php echo substr(htmlspecialchars($comment['comment_text']), 0, 50) . '...'; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></td>
                        <td>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                <input type="hidden" name="action" value="delete_comment">
                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Video Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Video</h2>
            <form method="POST" id="editForm" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_video">
                <input type="hidden" name="video_id" id="edit_video_id">
                <div class="form-group">
                    <label>Judul Video</label>
                    <input type="text" name="title" id="edit_title" required>
                </div>
                <div class="form-group">
                    <label>Upload Video File Baru (Opsional)</label>
                    <input type="file" name="video_file" accept=".mp4,.avi,.mov,.wmv,.webm" class="file-input">
                    <small style="color: rgba(255,255,255,0.7); display: block; margin-top: 5px;">
                        Kosongkan jika tidak ingin mengubah file
                    </small>
                </div>
                <div class="form-group">
                    <label>ATAU URL Video</label>
                    <input type="url" name="video_url" id="edit_video_url">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" id="edit_description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn">Update Video</button>
            </form>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
        }
        
        function editVideo(id, title, videoUrl, description) {
            document.getElementById('edit_video_id').value = id;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_video_url').value = videoUrl;
            document.getElementById('edit_description').value = description;
            document.getElementById('editModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>