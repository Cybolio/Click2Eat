

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Dashboard - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="click2eatlogo.png" type="image/png">

  <style>
    .rider-header-content {
      text-align: left;
      padding: 1.5rem 2rem;
      background-color: var(--surface);
      border-radius: 8px;
      margin-bottom: 2rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .rider-header-content h1 {
      margin-bottom: 0.5rem;
      color: var(--accent-warm);
    }

    .rider-info p {
      margin-bottom: 0.3rem;
      color: var(--text);
      font-size: 0.95rem;
    }

    .section-box {
      max-width: 900px;
      margin: 0 auto 2rem auto;
      padding: 2rem;
      background-color: var(--surface);
      border-radius: 14px;
      border: 1px solid var(--accent-soft);
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .section-box h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: var(--accent);
      border-bottom: 2px solid var(--accent-soft);
      padding-bottom: 0.5rem;
    }

    .order-card {
      padding: 1rem;
      border-bottom: 1px dashed var(--accent-soft);
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 1rem;
    }

    .order-card:last-child {
      border-bottom: none;
    }

    .order-details p {
      margin: 0.2rem 0;
      font-size: 0.9rem;
      color: var(--text);
    }

    .order-status {
      font-weight: bold;
      color: var(--accent-warm);
      font-size: 1rem;
    }

    .action-btn {
      display: inline-block;
      padding: 0.7rem 1rem;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: 0.3s;
      text-align: center;
      margin-top: 0.5rem;
      background-color: var(--accent-soft);
      color: var(--text);
    }

    .action-btn:hover {
      background-color: var(--accent);
      color: #fff8ec;
    }
  </style>
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
