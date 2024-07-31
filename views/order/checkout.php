<?php
$title = "Checkout";
include 'base.php'; // Inclure le fichier de base qui pourrait contenir des en-têtes et autres inclusions globales
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Inclure le fichier CSS -->
    <!-- Ajouter les autres inclusions nécessaires -->
    <script src="https://js.stripe.com/v3/"></script> <!-- Inclure Stripe.js -->
    <script src="path/to/your/js/file.js" defer></script> <!-- Inclure le fichier JS -->
</head>
<body>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Commander</li>
        <li class="breadcrumb-item">Plus qu'une dernière étape</li>
    </ol>
</nav>

<!-- check out section -->
<div class="checkout-section mt-150 mb-150" x-data="stripePayment()" x-init="initStripe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button
                                        class="btn btn-link"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="true"
                                        aria-controls="collapseOne"
                                    >
                                        Billing Address
                                    </button>
                                </h5>
                            </div>

                            <div
                                id="collapseOne"
                                class="collapse show"
                                aria-labelledby="headingOne"
                                data-parent="#accordionExample"
                            >
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <form method="post">
                                            <p><input type="text" placeholder="Name" /></p>
                                            <p><input type="email" placeholder="Email" /></p>
                                            <p><input type="text" placeholder="Address" /></p>
                                            <p><input type="tel" placeholder="Phone" /></p>
                                            <p>
                                                <textarea
                                                    name="bill"
                                                    id="bill"
                                                    cols="30"
                                                    rows="10"
                                                    placeholder="Say Something"
                                                ></textarea>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card single-accordion">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button
                                        class="btn btn-link collapsed"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#collapseTwo"
                                        aria-expanded="false"
                                        aria-controls="collapseTwo"
                                    >
                                        Shipping Address
                                    </button>
                                </h5>
                            </div>
                            <div
                                id="collapseTwo"
                                class="collapse"
                                aria-labelledby="headingTwo"
                                data-parent="#accordionExample"
                            >
                                <div class="card-body">
                                    <div class="shipping-address-form">
                                        <p>Your shipping address form is here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card single-accordion">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button
                                        class="btn btn-link collapsed"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#collapseThree"
                                        aria-expanded="false"
                                        aria-controls="collapseThree"
                                    >
                                        Card Details
                                    </button>
                                </h5>
                            </div>
                            <div
                                id="collapseThree"
                                class="collapse"
                                aria-labelledby="headingThree"
                                data-parent="#accordionExample"
                            >
                                <div class="card-body">
                                    <div class="card-details">
                                        <p>Your card details goes here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-details-wrap">
                    <table class="order-details">
                        <thead>
                            <tr>
                                <th>Your order Details</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="order-details-body">
                            <tr>
                                <td>Product</td>
                                <td>Total</td>
                            </tr>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['product']['name']); ?></td>
                                <td><?php echo htmlspecialchars($order['product']['price']); ?> $</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tr class="bg-dark">
                            <td class="bg-dark py-1"></td>
                            <td class="bg-dark py-1"></td>
                        </tr>
                        <tbody class="checkout-details bg-dark-subtle">
                            <tr>
                                <td>Subtotal</td>
                                <td><?php echo htmlspecialchars($order_cumul); ?></td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><?php echo htmlspecialchars($order_cumul); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="checkout-stripe-button" onclick="stripePayment()">Checkout Avec Stripe</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->

</body>
</html>
