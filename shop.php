    <?php
        require_once __DIR__ . '/db/Database.php';

        try {
        $db = Database::getInstance();
        $pdo = $db->getConnection();

        $stmt = $pdo->query("SELECT * FROM products LIMIT 8");
        $featuredProducts = $stmt->fetchAll();

        $stmt = $pdo->query("SELECT * FROM pc_parts");
        $pcParts = $stmt->fetchAll();
        } catch (Exception $e) {
        error_log("Index page error: " . $e->getMessage());
        $featuredProducts = [];
        $pcParts = [];
        }
    ?>
    
    <?php include_once 'includes/header.php' ?>
    <section id="page-header">
        <h2>PC Gateway</h2>
        <p>Save more with coupons & up to 70% off! </p>
    </section>
    <section id="product1" class="section-p1">
        <h1>Featured Products</h1>
        <p>Selected Pre-builts for maximum gaming performance</p>
        <div class="dropdowns">
            <label for="sort">Sort By:</label>
            <select id="sort">
                <option value="lowtohigh">Price: Low to High</option>
                <option value="hightolow">Price: High to Low</option>
                <option value="az">Alphabetically A-Z</option>
                <option value="za">Alphabetically Z-A</option>
            </select>
            <label for="filter">Filter By:</label>
            <select id="filter">
                <option value="all">All</option>
                <option value="Silicon">Silicon</option>
                <option value="Hypernova">Hypernova</option>
                <option value="Alpine">Alpine</option>
                <option value="Arctic">Arctic</option>
                <option value="Blizzard">Blizzard</option>
                <option value="Cloud">Cloud</option>
                <option value="Data">Data</option>
            </select>
        </div>
        <div class="pro-container">
            <?php
            require_once __DIR__ . '/db/Database.php';
            $db = Database::getInstance();
            $pdo = $db->getConnection();

            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll();

            foreach ($products as $product) {
                $brand = explode(' ', $product['product_title'])[0];

                echo '<div class="pro" data-brand="' . $brand . '" data-price="' . str_replace(['€', ',', '.'], '', $product['price']) . '" data-title="' . $product['product_title'] . '">
            <a href="product.php?id=' . $product['id'] . '"><img src="' . $product['main_image'] . '" alt="" style="height:320px"></a>
            <div class="des">
                <span>' . $brand . '</span>
                <h5>' . $product['product_title'] . '</h5>
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h4>' . $product['price'] . '</h4>
            </div>
            <a href="#"><i class="fa fa-shopping-cart cart"></i></a>
        </div>';
            }
            ?>
        </div>
    </section>
    <?php include_once 'includes/slider.php'?>
    <section id="pagination" class="section-p1">
        <a href="shop.php">1</a>
        <a href="shop.php">2</a>
        <a href="shop.php">&rarr;</a>
    </section>
    <?php include_once 'includes/newsletter.php' ?>
    <?php include_once 'includes/footer.php' ?>
    </body>

    </html>