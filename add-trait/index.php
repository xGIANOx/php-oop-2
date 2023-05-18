<?php

trait Discount {
    protected $discountPercentage;

    public function setDiscountPercentage($percentage) {
        $this->discountPercentage = $percentage;
    }

    public function getDiscountedPrice($price) {
        $discountedAmount = $price * ($this->discountPercentage / 100);
        return $price - $discountedAmount;
    }
}

class Computer {
    public $brand;
    public $model;
    public $image;

    public function __construct($brand, $model, $image) {
        $this->brand = $brand;
        $this->model = $model;
        $this->image = $image;
    }

    public function getProductType() {
        return "Computer";
    }
}

class Desktop extends Computer {
    use Discount;

    public $GPU;

    public function __construct($brand, $model, $GPU, $image) {
        parent::__construct($brand, $model, $image);
        $this->GPU = $GPU;
    }

    public function getProductType() {
        return "Desktop";
    }
}

class Laptop extends Computer {
    use Discount;

    public function __construct($brand, $model, $image) {
        parent::__construct($brand, $model, $image);
    }

    public function getProductType() {
        return "Laptop";
    }
}

$computers = [
    new Desktop("Acer", "Aspire TC", "NVIDIA GeForce GTX 1660", "https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcT1u6y2GGmrJJnDbqVFon4LTfmpMfpfHQr8t4mqu1h0sOX2B7x9btD2fht2FAm0uuQ4jEdFo329Dx1lvniFMFWkztC5s86XJ1NJfHOh-nqY4HxyQL8BOg8jkHVNmj9RiQz3gy0&usqp=CAc"),
    new Desktop("Dell", "Optiplex SFF 7040", "AMD Radeon RX 580","https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcRVIybUz3eFLkn6vCmafwK1vhZe8WGaGZCVYm-cVLy_9L5ucDzNzpbxyrDmqzQg1hQbIvk_pHPrU-nB9hUyyjHaiQ_LWtf9ozrQi85Ws9ZJjXay1PmRTR3D3qLwmBHyrFnADg&usqp=CAc"),
    new Laptop("Apple", "MacBookAir", "https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSBkHKk4wd2C1sv8boOr837h1q3w0lf0jWmFuOXC_ADLB39AzgoFMHb2Z-adjkW2rAQsZ9wG6VCCUmOGJECUopf1R0OHhFrhCSfibbOjTCtBFm0j7vPzvLhClv0COgu1a-JIro&usqp=CAc"),
    new Laptop("Apple", "MacBook Pro", "https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSb-Ero-rrMWl5c___0EhuH3uTb0skazUS8mavYwAgqIlhk1NtnOiZ-5zkKDBeH0eTjfavtQHhEj5T5qF3fwConcC2R9X905DnSxBmbtTmaq7An569ZYR4Lg3f8kpRpQiAqx3E&usqp=CAc"),
];

// Apply a 10% discount on the first two cards
$computers[0]->setDiscountPercentage(10);
$computers[1]->setDiscountPercentage(10);

?>

<!DOCTYPE html>
<html>
<head>
    <title>OOP Computer Catalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .computer-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
        }

        .computer-card .card-img-top {
            height: 200px;
            object-fit: contain;
        }

        .computer-card .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
        }

        .computer-card .card-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .computer-card .card-text {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1 class="text-center my-5">OOP Computer Catalog</h1>
    <div class="container">
        <div class="row">
            <?php foreach ($computers as $computer): ?>
                <div class="col-6 my-3">
                    <div class="card computer-card mb-5">
                        <img src="<?php echo $computer->image; ?>" class="card-img-top mt-3" alt="Computer Image">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $computer->getProductType(); ?>
                            </h5>
                            <p class="card-text">
                                Brand: <?php echo $computer->brand; ?>
                            </p>
                            <p class="card-text">
                                Model: <?php echo $computer->model; ?>
                            </p>
                            <?php if ($computer instanceof Desktop): ?>
                                <p class="card-text">
                                    GPU: <?php echo $computer->GPU; ?>
                                </p>
                            <?php endif; ?>
                            <p class="card-text">
                                Price: €<?php echo $computer->getDiscountedPrice(1000); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>