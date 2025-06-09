<?php 
session_start();

// Cek apakah user sudah login dan merupakan admin
if(!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("php/config.php");

// --- DITAMBAHKAN: Fungsi untuk mengambil ID Video YouTube dari URL ---
function getYouTubeVideoId($url) {
    preg_match('/(youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $match);
    if (isset($match[2]) && strlen($match[2]) == 11) {
        return $match[2];
    }
    return null;
}
// --- AKHIR PENAMBAHAN FUNGSI ---

// Handle form submissions
if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'add_video':
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $video_url = mysqli_real_escape_string($con, $_POST['video_url']);
            $thumbnail_url = ''; // Variabel untuk menyimpan URL thumbnail

            // Wajibkan URL Video
            if(empty($video_url)) {
                $error_message = "URL Video YouTube wajib diisi!";
                break;
            }

            // --- DIMODIFIKASI: Logika untuk mengambil thumbnail otomatis ---
            $video_id = getYouTubeVideoId($video_url);

            if ($video_id) {
                // Gunakan thumbnail kualitas Standard Definition (sddefault), ini adalah pilihan aman.
                // Pilihan lain: maxresdefault.jpg (kualitas tertinggi, tapi mungkin tidak selalu ada), hqdefault.jpg, mqdefault.jpg
                $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/sddefault.jpg";
            } else {
                $error_message = "URL Video YouTube tidak valid atau tidak dapat diproses!";
                break;
            }
            // --- AKHIR MODIFIKASI THUMBNAIL ---
            
            // --- DIMODIFIKASI: Query INSERT menggunakan thumbnail_url ---
            $query = "INSERT INTO videos (title, video_url, description, thumbnail, created_at) VALUES ('$title', '$video_url', '$description', '$thumbnail_url', NOW())";
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
            $video_url = mysqli_real_escape_string($con, $_POST['video_url']);
            
            // --- DIMODIFIKASI: Logika untuk update thumbnail otomatis ---
            $video_id = getYouTubeVideoId($video_url);

            if ($video_id) {
                $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/sddefault.jpg";
            } else {
                $error_message = "URL Video YouTube tidak valid atau tidak dapat diproses!";
                break;
            }
            
            // Logika upload thumbnail baru dan hapus thumbnail lama DIHAPUS karena tidak diperlukan lagi
            // --- AKHIR MODIFIKASI ---
            
            // --- DIMODIFIKASI: Query UPDATE menggunakan thumbnail_url baru ---
            $query = "UPDATE videos SET title='$title', video_url='$video_url', description='$description', thumbnail='$thumbnail_url' WHERE id=$id";
            if(mysqli_query($con, $query)) {
                $success_message = "Video berhasil diupdate!";
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
            break;
            
        case 'delete_video':
            $id = $_POST['video_id'];
            
            // --- DIMODIFIKASI: Menghapus logika penghapusan file thumbnail fisik ---
            // Tidak perlu lagi mengambil info thumbnail dan menghapus file karena kita hanya menyimpan URL
            // if($video_info && file_exists($video_info['thumbnail'])) {
            //     unlink($video_info['thumbnail']);
            // }
            // --- AKHIR MODIFIKASI ---
            
            // Hapus komentar terkait video
            mysqli_query($con, "DELETE FROM comments WHERE video_id = $id");
            // Hapus video dari database
            $query = "DELETE FROM videos WHERE id = $id";
            if(mysqli_query($con, $query)) {
                $success_message = "Video dan komentar terkait berhasil dihapus!";
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

// Get comments
$comments_query = "SELECT c.*, u.Username, v.title as video_title FROM comments c JOIN users u ON c.user_id = u.Id JOIN videos v ON c.video_id = v.id ORDER BY c.created_at DESC";
$comments_result = mysqli_query($con, $comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
    <link rel="stylesheet" href="adminpanel.css">
    <style>
        .thumbnail-preview {
            max-width: 100px;
            max-height: 80px;
            border-radius: 5px;
            object-fit: cover; /* Tambahan agar gambar tidak gepeng */
        }
        #edit_current_thumbnail {
            max-width: 200px; 
            margin-bottom: 15px; 
            border-radius: 8px;
            display: block;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Admin Dashboard</h1>
    <div class="header-right">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="beranda.php" class="btn-home">Beranda</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <?php if(isset($success_message)): ?>
        <div class="message success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
        <div class="message error"><?php echo $error_message; ?></div>
    <?php endif; ?>

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

    <div class="tabs">
        <button class="tab active" onclick="showTab('videos')">Kelola Video</button>
        <button class="tab" onclick="showTab('comments')">Kelola Komentar</button>
    </div>

    <div id="videos" class="tab-content active">
        <h2 style="color: white; margin-bottom: 1rem;">Tambah Video Baru</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_video">
            <div class="form-group">
                <label>Judul Video</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>URL Video YouTube</label>
                <input type="url" name="video_url" placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ" required>
                <small style="color: rgba(255,255,255,0.7); display: block; margin-top: 5px;">
                    Cukup salin dan tempel URL video dari YouTube. Thumbnail akan diambil secara otomatis.
                </small>
            </div>
            <div class="form-group">
                <label>Pembahasan Untuk Video</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn">Tambah Video</button>
        </form>

        <h2 style="color: white; margin: 2rem 0 1rem 0;">Daftar Video</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>URL YouTube</th>
                    <th>Pembahasan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($video = mysqli_fetch_assoc($videos_result)): ?>
                <tr>
                    <td><?php echo $video['id']; ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($video['thumbnail']); ?>" alt="Thumbnail" class="thumbnail-preview">
                    </td>
                    <td><?php echo htmlspecialchars($video['title']); ?></td>
                    <td>
                        <a href="<?php echo htmlspecialchars($video['video_url']); ?>" target="_blank" style="color: #feca57;">Lihat Video</a>
                    </td>
                    <td><?php echo substr(htmlspecialchars($video['description']), 0, 50) . '...'; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($video['created_at'])); ?></td>
                    <td>
                        <button class="btn btn-edit" onclick="editVideo(
                            <?php echo $video['id']; ?>, 
                            '<?php echo addslashes(htmlspecialchars($video['title'])); ?>', 
                            '<?php echo addslashes(htmlspecialchars($video['video_url'])); ?>', 
                            '<?php echo addslashes(htmlspecialchars($video['description'])); ?>',
                            '<?php echo addslashes(htmlspecialchars($video['thumbnail'])); ?>'
                        )">Edit</button>
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

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <h2>Edit Video</h2>
        <form method="POST" id="editForm" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update_video">
            <input type="hidden" name="video_id" id="edit_video_id">
            
            <div class="form-group">
                <label>Thumbnail Saat Ini</label>
                <img id="edit_current_thumbnail" src="" alt="Current Thumbnail">
            </div>

            <div class="form-group">
                <label>Judul Video</label>
                <input type="text" name="title" id="edit_title" required>
            </div>
            <div class="form-group">
                <label>URL Video YouTube</label>
                <input type="url" name="video_url" id="edit_video_url" required>
                 <small style="color: rgba(255,255,255,0.7); display: block; margin-top: 5px;">
                    Jika Anda mengubah URL, thumbnail akan diperbarui secara otomatis.
                </small>
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
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.remove('active');
        });
        
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        
        document.getElementById(tabName).classList.add('active');
        // event.target tidak reliable jika event tidak di-pass, diganti dengan querySelector yg lebih spesifik
        document.querySelector(`.tab[onclick="showTab('${tabName}')"]`).classList.add('active');
    }
    
    // Fungsi JS tidak perlu diubah, karena sudah menerima URL thumbnail secara dinamis
    function editVideo(id, title, videoUrl, description, thumbnailUrl) {
        document.getElementById('edit_video_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_video_url').value = videoUrl;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_current_thumbnail').src = thumbnailUrl;
        document.getElementById('editModal').style.display = 'block';
    }
    
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
</body>
</html>