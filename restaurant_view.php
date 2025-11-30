<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Golden Wok Restaurant - Click2Eat</title>
  <link rel="stylesheet" href="styles.css">

  <link rel="icon" href="click2eatlogo.png" type="image/png">

  <style>
    .restaurant-header-content {
      text-align: left;
      padding: 1rem 2rem;
      background-color: var(--surface);
      border-radius: 8px;
      margin-bottom: 2rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .restaurant-header-content h1 {
      margin-bottom: 0.5rem;
      color: var(--accent-warm);
    }

    .restaurant-info p {
      margin-bottom: 0.3rem;
      color: var(--text);
      font-size: 0.95rem;
    }

    .menu-item {
      text-align: left;
      padding: 1rem;
      border-bottom: 1px dashed var(--accent-soft);
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }

    .menu-item:last-child {
      border-bottom: none;
    }

    .menu-item-details {
      flex-grow: 1;
    }

    .menu-item-name {
      font-size: 1.2rem;
      color: var(--accent);
      font-weight: bold;
    }

    .menu-item-description {
      font-size: 0.9rem;
      color: var(--text);
    }

    .menu-item-price {
      font-size: 1.3rem;
      color: var(--accent-warm);
      font-weight: bold;
    }

    .menu-section {
      text-align: left;
      max-width: 900px;
      margin: 0 auto 3rem auto;
      background-color: var(--surface);
      padding: 2rem;
      border-radius: 14px;
      border: 1px solid var(--accent-soft);
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }

    .menu-section h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: var(--accent);
      border-bottom: 2px solid var(--accent-soft);
      padding-bottom: 0.5rem;
    }
    
    /* New style for the link button */
    .add-item-button {
        display: block;
        max-width: 900px;
        width: 90%;
        margin: 1rem auto 3rem auto; /* Center button */
        padding: 0.8rem;
        background-color: var(--accent-soft);
        color: var(--text);
        border-radius: 6px;
        text-decoration: none;
        text-align: center;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .add-item-button:hover {
        background-color: var(--accent);
        color: #fff8ec;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
      </ul>
    </nav>

    <div class="banner">
      <img src="images/restaurant_cover.jpg" alt="The Golden Wok Restaurant Cover">
    </div>

    <div class="restaurant-header-content">
      <h1>Restaurant name</h1>
      <div class="restaurant-info">
        <p>📍 **Address:** 123 Dimsum Lane, Food District, City</p>
        <p>⭐ **Rating:** 4.7 (1,200+ ratings)</p>
        <p>🕒 **Hours:** 10:00 AM - 10:00 PM Daily</p>
        <p>📞 **Contact:** (555) 123-4567</p>
      </div>
    </div>
  </header>

  <main>
    <a href="restaurant_session_protector.php" class="add-item-button">➕ Add New Menu Item</a>

    <h2>Featured Dishes</h2>
    <section class="image-grid">
      <div class="Dish-1">
        <img src="images/dish_kungpao.jpg" alt="Kung Pao Chicken">
        <p>Kung Pao Chicken</p>
      </div>
      <div class="Dish-2">
        <img src="images/dish_dumplings.jpg" alt="Steamed Dumplings">
        <p>Steamed Dumplings</p>
      </div>
      <div class="Dish-3">
        <img src="images/dish_noodle.jpg" alt="Beef Noodle Soup">
        <p>Beef Noodle Soup</p>
      </div>
    </section>

    <section class="menu-section">
      <h2>Appetizers</h2>
      <div class="menu-item">
        <div class="menu-item-details">
          <div class="menu-item-name">Spring Rolls (4 pcs)</div>
          <div class="menu-item-description">Crispy rolls filled with shredded vegetables and pork. Served with sweet chili sauce.</div>
        </div>
        <div class="menu-item-price">$5.99</div>
      </div>
      <div class="menu-item">
        <div class="menu-item-details">
          <div class="menu-item-name">Pork Siomai</div>
          <div class="menu-item-description">Classic steamed pork dumplings. (4 pcs)</div>
        </div>
        <div class="menu-item-price">$4.50</div>
      </div>
    </section>

    <section class="menu-section">
      <h2>Main Courses</h2>
      <div class="menu-item">
        <div class="menu-item-details">
          <div class="menu-item-name">Sweet and Sour Pork</div>
          <div class="menu-item-description">Deep-fried pork pieces tossed in our tangy sweet and sour sauce.</div>
        </div>
        <div class="menu-item-price">$12.99</div>
      </div>
      <div class="menu-item">
        <div class="menu-item-details">
          <div class="menu-item-name">Beef Broccoli</div>
          <div class="menu-item-description">Tender slices of beef and fresh broccoli in a savory brown sauce.</div>
        </div>
        <div class="menu-item-price">$13.50</div>
      </div>
      <div class="menu-item">
        <div class="menu-item-details">
          <div class="menu-item-name">Special Fried Rice</div>
          <div class="menu-item-description">Wok-fried rice with shrimp, chicken, and mixed vegetables.</div>
        </div>
        <div class="menu-item-price">$9.99</div>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2025 Click2Eat | All Rights Reserved</p>
  </footer>
</body>
</html>