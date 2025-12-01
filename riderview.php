

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Dashboard - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">

</head>

<body>

  <header>
    <nav>
      <ul>
        <li><a href="rider_dashboard.html" class="active">Dashboard</a></li>
        <li><a href="rider_current_orders.html">Orders</a></li>
        <li><a href="rider_history.html">History</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

    <div class="banner">
      <img src="images/rider_banner.jpg" alt="Click2Eat Rider Banner">
    </div>

    <div class="rider-header-content">
      <h1>Rider Name</h1>
      <div class="rider-info">
        <p>📞 <strong>Phone:</strong> 0912-345-6789</p>
        <p>🏍️ <strong>Vehicle:</strong> Honda Click 125i (Red)</p>
        <p>🪪 <strong>License No.:</strong> A12-34-567890</p>
        <p>📍 <strong>Base Address:</strong> 45 Burgos Street, City</p>
      </div>
    </div>
  </header>

  <main>

    <!-- Current Delivery Section -->
    <section class="section-box">
      <h2>Current Delivery</h2>

      <div class="order-card">
        <div class="order-details">
          <p><strong>Order #:</strong> 2025-00421</p>
          <p><strong>Pickup:</strong> Golden Wok Restaurant</p>
          <p><strong>Drop-off:</strong> 78 Jasmine Street, City</p>
          <p><strong>Customer:</strong> Juan Dela Cruz</p>
          <p><strong>Status:</strong> <span class="order-status">Waiting for Pickup</span></p>
        </div>

        <div>
          <a href="#" class="action-btn">View Order</a>
          <a href="#" class="action-btn">Mark as Picked Up</a>
        </div>
      </div>
    </section>


    <!-- Available Orders Section -->
    <section class="section-box">
      <h2>Available Orders</h2>

      <div class="order-card">
        <div class="order-details">
          <p><strong>Order #:</strong> 2025-00419</p>
          <p><strong>Restaurant:</strong> Chow Mix Express</p>
          <p><strong>Distance:</strong> 1.8 km</p>
          <p><strong>Payout:</strong> ₱52.00</p>
        </div>
        <div>
          <a href="#" class="action-btn">Accept Order</a>
        </div>
      </div>

      <div class="order-card">
        <div class="order-details">
          <p><strong>Order #:</strong> 2025-00418</p>
          <p><strong>Restaurant:</strong> Pizza Bite House</p>
          <p><strong>Distance:</strong> 3.2 km</p>
          <p><strong>Payout:</strong> ₱64.00</p>
        </div>
        <div>
          <a href="#" class="action-btn">Accept Order</a>
        </div>
      </div>

    </section>

  </main>

  <footer>
    <p>© 2025 Click2Eat | Rider Platform</p>
  </footer>

</body>
</html>
