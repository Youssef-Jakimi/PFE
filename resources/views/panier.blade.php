<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/tabl.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Document</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-section {
            flex: 2;
            padding-right: 20px;
        }

        .payment-section {
            flex: 1;
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: left;
        }

        .cart-item h3 {
            font-size: 1.2rem;
            color: #333;
            margin: 10px 0;
        }

        .cart-item p {
            font-size: 1.1rem;
            color: #555;
        }

        .cart-summary {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 1.2rem;
            color: #333;
        }

        .payment-options {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .payment-options input[type="radio"] {
            margin-right: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            max-width: 250px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        /* Credit Card Form */
        .credit-card-form {
            display: none;
            margin-top: 20px;
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .credit-card-form input {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .credit-card-form .expiry-date {
            display: flex;
            gap: 10px;
        }

        .credit-card-form .expiry-date input {
            width: 48%;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }

            .cart-section {
                padding-right: 0;
            }

            .payment-section {
                margin-top: 20px;
            }

            .cart-items {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Cart Section -->
        <div class="cart-section">
            <h1>PANIER</h1>
            @if($panier->count() == 0)
                <p>Your cart is empty.</p>
            @else
                <div class="cart-items">
                    @foreach($panier as $produit)
                        <div class="cart-item">
                            <h3>{{ $produit->name }}</h3>  <!-- Product title -->
                            <h3>{{ $produit->ref }}</h3>  <!-- Product reference -->
                            <h3>{{ $produit->Prix_Total}}</h3>  <!-- Total price -->
                            <h3>{{ $produit->Date_F }}</h3>  <!-- End date -->
                            <h3>{{ $produit->Date_D }}</h3>  <!-- Start date -->
                            <p>Price: {{$produit->Prix_Total}} MAD</p>  <!-- Product price -->
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <h3>Total Price: {{$total}} MAD</h3>  <!-- Total cart price -->
                </div>
            @endif
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
            <form action="{{ route('confirmerCommande') }}" method="post"> 
                @csrf
                @if($panier->count() != 0)
                    <!-- Payment Options (Cash/Card) -->
                    <div class="payment-options">
                        <label>
                            <input type="radio" name="payment_method" value="cash" id="cash-payment" onclick="togglePaymentForm()" checked>
                            <h3>Payer en espèces</h3>
                        </label>

                        <label>
                            <input type="radio" name="payment_method" value="card" id="card-payment" onclick="togglePaymentForm()">
                            <h3>Payer par carte</h3>
                        </label>
                    </div>

                    <!-- Credit Card Form -->
                    <div class="credit-card-form" id="credit-card-form">
                        <h3>Card Details</h3>
                        <input type="text" name="card-name" placeholder="Cardholder Name" required>
                        <input type="number" name="card-number" placeholder="Card Number" required>
                        
                        <!-- Expiration Date with Month and Year -->
                        <div class="expiry-date">
                            <input type="number" name="card-expiry-month" placeholder="MM" required maxlength="2" min="01" max="12">
                            <input type="number" name="card-expiry-year" placeholder="YY" required maxlength="2">
                        </div>

                        <!-- CVC with 3 digits -->
                        <input type="number" name="card-cvc" placeholder="CVC" required maxlength="3" minlength="3">

                    </div>

                    <button type="submit" id="myButton" disabled>Confirmer Votre Commande</button>
                @endif
            </form>
        </div>
    </div>

    <script>
        function togglePaymentForm() {
            const cashPayment = document.getElementById('cash-payment');
            const cardPayment = document.getElementById('card-payment');
            const creditCardForm = document.getElementById('credit-card-form');
            const submitButton = document.getElementById('myButton');

            // Enable/disable button based on selected payment method
            if (cashPayment.checked) {
                creditCardForm.style.display = "none";  // Hide the credit card form
                submitButton.disabled = false;          // Enable button (cash payment)
            } else if (cardPayment.checked) {
                creditCardForm.style.display = "block"; // Show the credit card form
                // Check if card details are filled to enable the button
                const cardName = document.querySelector('input[name="card-name"]');
                const cardNumber = document.querySelector('input[name="card-number"]');
                const cardExpiryMonth = document.querySelector('input[name="card-expiry-month"]');
                const cardExpiryYear = document.querySelector('input[name="card-expiry-year"]');
                const cardCVC = document.querySelector('input[name="card-cvc"]');

                // Enable button only if all fields are filled
                submitButton.disabled = !(cardName.value && cardNumber.value && cardExpiryMonth.value && cardExpiryYear.value && cardCVC.value);
            }
        }

        // Initialize the payment form toggle on page load
        document.addEventListener('DOMContentLoaded', function () {
            togglePaymentForm();
        });
    </script>

</body>
</html>
