<?php
include("connection.php");
include("session_customer.php");
?>
<style>
  :root {
    --primary-bg: #ffffff;
    --secondary-bg: #f8f9fa;
    --text-color: #333333;
    --border-color: #e0e0e0;
    --hover-bg: #e9ecef;
    --card-bg: #ffffff;
    --shadow-color: rgba(0, 0, 0, 0.1);
  }

  [data-theme="dark"] {
    --primary-bg: #1a1a1a;
    --secondary-bg: #2d2d2d;
    --text-color: #ffffff;
    --border-color: #404040;
    --hover-bg: #404040;
    --card-bg: #2d2d2d;
    --shadow-color: rgba(0, 0, 0, 0.3);
  }

  body {
    background-color: var(--primary-bg);
    color: var(--text-color);
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .header_area {
    background-color: var(--primary-bg);
    border-bottom: 1px solid var(--border-color);
  }

  .menu-button, .home-button {
    background: var(--secondary-bg);
    color: var(--text-color);
    border: 1px solid var(--border-color);
  }

  .menu-button:hover, .home-button:hover {
    background: var(--hover-bg);
  }

  .cart-icon {
    color: var(--text-color);
    background: var(--secondary-bg);
  }

  .theme-toggle {
    background: var(--secondary-bg);
    border: 1px solid var(--border-color);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 10px;
  }

  .theme-toggle:hover {
    background: var(--hover-bg);
  }

  .theme-toggle i {
    color: var(--text-color);
    font-size: 18px;
  }

 .header_area .navbar .nav .nav-item {
  margin-right: 45px;
  margin-right: 23px;
  margin-bottom: -17.0px;
  padding: -1.4px;
  margin-top: -14.2px;
  }

  /* Menu Container Styles */
  .menu-container {
    position: relative;
    display: inline-block;
    margin: 0 auto;
  }

  .menu-button, .home-button {
    padding: 6px 15px;
    border-radius: 15px;
    cursor: pointer;
    font-weight: 500;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    text-transform: none;
    letter-spacing: normal;
    margin: 0 3px;
    text-decoration: none;
  }

  .menu-button:hover, .home-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-decoration: none;
  }

  .menu-button i, .home-button i {
    font-size: 14px;
  }

  /* Categories Dropdown */
  .categories-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    min-width: 250px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 4px;
    display: none;
    z-index: 1000;
  }

  .category-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .category-item {
    padding: 10px 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
  }

  .category-item:hover {
    background: #fff9f5;
    color: #FF6600;
  }

  .category-link {
    color: #333;
    text-decoration: none;
    display: block;
    width: 100%;
    padding: 5px 0;
  }

  .category-link:hover {
    color: #FF6600;
  }

  /* Subcategories Dropdown */
  .subcategories-dropdown {
    position: absolute;
    top: 0;
    left: 100%;
    background: white;
    min-width: 250px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 4px;
    display: none;
    z-index: 1001;
  }

  .subcategory-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .subcategory-item {
    padding: 10px 15px;
    transition: all 0.3s ease;
  }

  .subcategory-item:hover {
    background: #fff9f5;
    color: #FF6600;
  }

  .subcategory-item a {
    color: #333;
    text-decoration: none;
    display: block;
  }

  .subcategory-item a:hover {
    color: #FF6600;
  }

  /* Caret Styling */
  .caret {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: 5px;
    vertical-align: middle;
    border-top: 5px solid;
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    transition: transform 0.3s ease;
  }

  .menu-button:hover .caret {
    transform: rotate(180deg);
  }

  /* Right side menu styles */
  .right-menu {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: auto;
    margin-right: 0;
    padding-right: 10px;
  }

  .right-menu-item {
    position: relative;
    padding: 0 10px;
  }

  /* Remove bullet points */
  .right-menu-item:not(:last-child)::after {
    display: none;
  }

  .cart-icon {
    position: relative;
    font-size: 20px;
    cursor: pointer;
    padding: 6px;
    border-radius: 50%;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .cart-icon:hover {
    transform: translateY(-2px);
    text-decoration: none;
  }

  .cart-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #FF6600;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 11px;
    font-weight: 600;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .profile-dropdown {
    position: relative;
  }

  .profile-button {
    background: var(--secondary-bg);
    color: var(--text-color);
    padding: 8px 15px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .profile-image {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .profile-button:hover {
    background: var(--hover-bg);
  }

  .profile-button i {
    font-size: 12px;
    transition: transform 0.3s ease;
  }

  .profile-dropdown:hover .profile-button i {
    transform: rotate(180deg);
  }

  .dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: var(--card-bg);
    min-width: 200px;
    box-shadow: 0 4px 12px var(--shadow-color);
    border-radius: 8px;
    z-index: 1000;
    margin-top: 10px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
  }

  .profile-dropdown.active .dropdown-content {
    display: block;
  }

  .dropdown-content a {
    color: var(--text-color);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: all 0.3s ease;
    font-size: 14px;
    border-bottom: 1px solid var(--border-color);
  }

  .dropdown-content a:last-child {
    border-bottom: none;
  }

  .dropdown-content a:hover {
    background: var(--hover-bg);
    color: #FF6600;
    padding-left: 20px;
  }

  .login-button {
    background: #f8f9fa;
    color: #333;
    padding: 8px 20px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
  }

  .login-button:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    color: #FF6600;
  }

  /* Header layout */
  .navbar-collapse {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0 20px;
  }

  .logo-container {
    margin-right: auto;
    margin-left: -40px;
  }

  .logo_h img {
    width: 150px;
    margin-left: 0;
  }

  .header-center {
    display: flex;
    justify-content: center;
    flex: 1;
    margin: 0 20px;
    max-width: 600px;
  }

  .center-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
  }

  .search-button {
    background: #f8f9fa;
    color: #333;
    padding: 6px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    cursor: pointer;
    font-weight: 500;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    text-transform: none;
    letter-spacing: normal;
    margin: 0 3px;
    position: relative;
    min-width: 200px;
    text-decoration: none;
  }

  .search-button:hover {
    text-decoration: none;
  }

  .search-input {
    border: none;
    background: transparent;
    padding: 0;
    margin: 0;
    width: 100%;
    font-size: 13px;
    outline: none;
    color: #333;
    text-decoration: none;
  }

  .search-input:focus {
    text-decoration: none;
  }

  .search-input::placeholder {
    color: #666;
  }

  .search-results {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    width: 100%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 8px;
    display: none;
    z-index: 1000;
    margin-top: 5px;
    border: 1px solid #eee;
    max-height: 300px;
    overflow-y: auto;
  }

  .search-result-item {
    padding: 10px 15px;
    border-bottom: 1px solid #f5f5f5;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .search-result-item:hover {
    background: #f8f9fa;
  }

  .search-result-item a {
    color: #333;
    text-decoration: none;
    display: block;
  }

  .search-result-item:hover a {
    color: #FF6600;
  }

  .search-result-category {
    font-size: 12px;
    color: #666;
    margin-top: 2px;
  }

  .search-container {
    margin-left: 15px;
    flex: 1;
    max-width: 200px;
  }

  @media (max-width: 991px) {
    .header-center {
      max-width: 100%;
      margin: 0 10px;
    }
    
    .search-container {
      max-width: 180px;
    }
    
    .search-button {
      min-width: 180px;
    }
    
    .right-menu {
      gap: 10px;
    }
  }
</style>
<header class="header_area">
	<div class="main_menu">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container">
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<div class="logo-container">
						<a class="navbar-brand logo_h" href="index.php"><img src="img/croma.png"></a>
					</div>
					<div class="header-center">
						<div class="center-buttons">
							<a href="index.php" class="home-button">
								<i class="ti-home"></i> Home
							</a>
							<div class="menu-container">
								<button class="menu-button" onclick="toggleMenu()">
									<i class="ti-menu"></i> Menu
								</button>
								<div class="categories-dropdown" id="categoriesDropdown">
									<ul class="category-list">
										<?php
										$sel1 = "SELECT * FROM category";
										$res1 = mysqli_query($conn, $sel1);
										while ($row1 = mysqli_fetch_array($res1)) {
											$catid = $row1['category_id'];
										?>
											<li class="category-item" onmouseover="showSubcategories(<?php echo $catid; ?>)" onmouseout="hideSubcategories(<?php echo $catid; ?>)">
												<a href="customer_product.php?cid=<?php echo $catid; ?>" class="category-link">
													<?php echo $row1['category_name']; ?>
												</a>
												<div class="subcategories-dropdown" id="subcategories-<?php echo $catid; ?>">
													<ul class="subcategory-list">
														<?php
														$sel16 = "SELECT * FROM subcategory WHERE cid = '$catid'";
														$res16 = mysqli_query($conn, $sel16);
														while ($row16 = mysqli_fetch_array($res16)) {
														?>
															<li class="subcategory-item">
																<a href="customer_product.php?subid=<?php echo $row16['subcategory_id']; ?>&cid=<?php echo $catid; ?>">
																	<?php echo $row16['subcategory_name']; ?>
																</a>
															</li>
														<?php } ?>
													</ul>
												</div>
											</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="search-container">
								<div class="search-button">
									<i class="ti-search"></i>
									<input type="text" class="search-input" placeholder="Search..." onkeyup="performSearch(this.value)">
									<div class="search-results" id="searchResults"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="right-menu">
						<div class="right-menu-item">
							<a href="add_to_cart.php" class="cart-icon">
								<i class="ti-shopping-cart"></i>
								<span class="cart-badge">
									<?php 
									$scart1 = "SELECT * FROM c_cart
									JOIN product_size_price ON product_size_price.psp_id = c_cart.psp_id
									JOIN product_entry ON product_size_price.pe_code = product_entry.pe_code
									WHERE cc_username = '$email' AND cc_status = 'cart'";
									$rcart1 = mysqli_query($conn, $scart1);
									echo mysqli_num_rows($rcart1);
									?>
								</span>
							</a>
						</div>
						<?php if (isset($_SESSION['customer'])) { ?>
							<div class="right-menu-item">
								<div class="profile-dropdown">
									<button class="profile-button" onclick="toggleDropdown(this)">
										<img src="<?php echo $image; ?>" alt="Profile" class="profile-image">
										<?php echo $fullname; ?> 
										<i class="ti-angle-down"></i>
									</button>
									<div class="dropdown-content">
										<a href="myorder.php"><i class="ti-shopping-cart-full"></i> My Orders</a>
										<a href="wishlist.php"><i class="ti-heart"></i> Wishlist</a>
										<a href="viewprofile.php"><i class="ti-user"></i> View Profile</a>
										<a href="changepassword.php"><i class="ti-key"></i> Change Password</a>
										<a href="logout.php"><i class="ti-power-off"></i> Logout</a>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="right-menu-item">
								<a href="login.php" class="login-button">
									<i class="ti-user"></i> Login
								</a>
							</div>
						<?php } ?>
						<div class="theme-toggle" onclick="toggleTheme()">
							<i class="fas fa-moon"></i>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
</header>

<script>
	function toggleMenu() {
		var dropdown = document.getElementById('categoriesDropdown');
		if (dropdown.style.display === 'block') {
			dropdown.style.display = 'none';
		} else {
			dropdown.style.display = 'block';
		}
	}

	function showSubcategories(categoryId) {
		var subcategories = document.getElementById('subcategories-' + categoryId);
		subcategories.style.display = 'block';
	}

	function hideSubcategories(categoryId) {
		var subcategories = document.getElementById('subcategories-' + categoryId);
		subcategories.style.display = 'none';
	}

	// Close dropdown when clicking outside
	document.addEventListener('click', function(event) {
		var menuContainer = document.querySelector('.menu-container');
		if (!menuContainer.contains(event.target)) {
			document.getElementById('categoriesDropdown').style.display = 'none';
			var allSubcategories = document.querySelectorAll('.subcategories-dropdown');
			allSubcategories.forEach(function(subcategory) {
				subcategory.style.display = 'none';
			});
		}
	});

	function performSearch(query) {
		var resultsDiv = document.getElementById('searchResults');
		
		if (query.length < 2) {
			resultsDiv.style.display = 'none';
			return;
		}

		// Create XMLHttpRequest object
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				resultsDiv.innerHTML = this.responseText;
				if (this.responseText.trim() !== '') {
					resultsDiv.style.display = 'block';
				} else {
					resultsDiv.style.display = 'none';
				}
			}
		};
		
		// Send the search query to search.php
		xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
		xhr.send();
	}

	// Close search results when clicking outside
	document.addEventListener('click', function(event) {
		var searchContainer = document.querySelector('.search-container');
		var searchResults = document.getElementById('searchResults');
		if (!searchContainer.contains(event.target)) {
			searchResults.style.display = 'none';
		}
	});

	// Check for saved theme preference
	const currentTheme = localStorage.getItem('theme') || 'light';
	document.documentElement.setAttribute('data-theme', currentTheme);
	updateThemeIcon();

	function toggleTheme() {
		const currentTheme = document.documentElement.getAttribute('data-theme');
		const newTheme = currentTheme === 'light' ? 'dark' : 'light';
		document.documentElement.setAttribute('data-theme', newTheme);
		localStorage.setItem('theme', newTheme);
		updateThemeIcon();
	}

	function updateThemeIcon() {
		const themeToggle = document.querySelector('.theme-toggle i');
		const currentTheme = document.documentElement.getAttribute('data-theme');
		themeToggle.className = currentTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
	}

	// Update dropdown toggle function
	function toggleDropdown(element) {
		const dropdown = element.closest('.profile-dropdown');
		dropdown.classList.toggle('active');
	}

	// Close dropdown when clicking outside
	document.addEventListener('click', function(event) {
		const dropdowns = document.querySelectorAll('.profile-dropdown');
		dropdowns.forEach(dropdown => {
			if (!dropdown.contains(event.target)) {
				dropdown.classList.remove('active');
			}
		});
	});
</script>