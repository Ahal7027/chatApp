<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<link rel="stylesheet" href="css/style.css">
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <!-- Add user items dynamically -->
      </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
      <div class="footer-item chat">
        <a href="#">
          <i class="fas fa-comments"></i>
          <p>Chat</p>
          <span class="chat-notification"></span> <!-- Notification dot -->
        </a>
      </div>
      <div class="footer-item">
        <a href="status.php">
          <i class="fas fa-pen"></i>
          <p>Status</p>
        </a>
      </div>
      <div class="footer-item">
        <a href="profile.php">
          <i class="fas fa-user"></i>
          <p>Profile</p>
        </a>
      </div>
    </footer>
  </div>

  <script src="javascript/users.js"></script>
</body>
</html>
