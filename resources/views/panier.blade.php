<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/panier.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


    <title>Checkout</title>
    <style>
       :root {
            --primary-color: #b8860b; /* Or foncé */
            --secondary-color: #2c3e50; /* Bleu marine */
            --accent-color: #d4af37; /* Or */
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-color: #212529;
            --background-color: #f0efe7; /* Beige très clair */
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --text-color: #333;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .cart-section {
            flex: 3;
            padding: 30px;
            border-right: 1px solid var(--medium-gray);
        }

        .payment-section {
            flex: 2;
            padding: 30px;
            background-color: var(--light-gray);
        }

        h1 {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 24px;
            position: relative;
            display: inline-block;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        h3 {
            font-size: 1.1rem;
            margin: 8px 0;
            font-weight: 500;
            color: #444;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .cart-item {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
            border: 1px solid var(--medium-gray);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .cart-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .item-detail {
            margin-bottom: 5px;
        }

        .item-detail span {
            font-weight: 600;
            color: #555;
            margin-right: 5px;
        }

        .item-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 600;
            margin-top: 8px;
        }

        .cart-summary {
            background-color: var(--light-gray);
            padding: 20px;
            border-radius: var(--border-radius);
            border: 1px solid var(--medium-gray);
            margin-top: 20px;
        }

        .cart-summary h3 {
            font-size: 1.3rem;
            color: var(--text-color);
            margin: 0;
            text-align: right;
        }

        .payment-options {
            margin-bottom: 30px;
        }

        .payment-method {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid var(--medium-gray);
        }

        .payment-method:hover {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .payment-method.active {
            background-color: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .payment-method input[type="radio"] {
            margin-right: 15px;
            cursor: pointer;
            accent-color: var(--primary-color);
            width: 18px;
            height: 18px;
        }

        .payment-method h3 {
            margin: 0;
            font-weight: 500;
        }

        .payment-icon {
            margin-left: auto;
            color: #888;
            font-size: 1.5rem;
        }

        .credit-card-form {
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: #666;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.1);
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 14px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.25);
        }

        button:disabled {
            background-color: #b8b8b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .empty-cart {
            text-align: center;
            padding: 30px;
            color: #888;
        }

        .empty-cart i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        .validation-error {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 992px) {
            .container {
                width: 95%;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .cart-section {
                border-right: none;
                border-bottom: 1px solid var(--medium-gray);
            }

            .cart-item {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                width: 100%;
                margin: 10px auto;
            }

            .cart-section, .payment-section {
                padding: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    
</head>
<body>

    <div class="container">
        <div class="cart-section">
            <h1>PANIER</h1>
            @if(session('alert'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('alert') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endif
            @if($panier->count() == 0)
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Votre panier est vide.</p>
                </div>
            @else
                <div class="cart-items">
                    @foreach($panier as $produit)
                        <div class="cart-item">
                            <div>
                                <div class="item-detail"><span>Produit:</span> {{ $produit->name }}</div>
                                <div class="item-detail"><span>Date début:</span> {{ $produit->Date_D }}</div>
                                <div class="item-detail"><span>Date fin:</span> {{ $produit->Date_F }}</div>

                            </div>
                            <div>
                                <div class="item-detail"><span>Référence:</span> {{ $produit->ref }}</div>
                                <div class="item-price">{{ $produit->Prix_Total }} MAD</div>
                                    <form action="{{ route('deleteProduct') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                        <button class="delete-product-btn" >
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                            </div>
                        </div>
                    @endforeach
                    
                </div>

                <div class="cart-summary">
                    <h3>Total: {{$total}} MAD</h3>
                </div>
                
            @endif
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
            <h1>PAIEMENT</h1>
            <form id="payment-form" action="{{ route('confirmerCommande') }}" method="post">
                @csrf
                @if($panier->count() != 0)
                    <!-- Payment Options (Cash/Card) -->
                    <div class="payment-options">
                        <div class="payment-method active" id="cash-method">
                            <input type="radio" name="payment_method" value="cash" id="cash-payment" checked>
                            <h3>Payer en espèces</h3>
                            <i class="fas fa-money-bill-wave payment-icon"></i>
                        </div>

                        <div class="payment-method" id="card-method">
                            <input type="radio" name="payment_method" value="card" id="card-payment">
                            <h3>Payer par carte</h3>
                            <i class="fas fa-credit-card payment-icon"></i>
                        </div>
                    </div>

                    <div class="credit-card-form" id="credit-card-form">
                        <div class="form-group">
                            <label for="card-name">Nom du titulaire</label>
                            <input type="text" id="card-name" name="card-name" placeholder="Nom complet">
                            <div class="validation-error" id="name-error">Veuillez entrer un nom valide</div>
                        </div>

                        <div class="form-group">
                            <label for="card-number">Numéro de carte</label>
                            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
                            <div class="validation-error" id="number-error">Veuillez entrer un numéro de carte valide</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="card-expiry">Date d'expiration</label>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="text" id="card-expiry-month" name="card-expiry-month" placeholder="MM" maxlength="2">
                                        <div class="validation-error" id="month-error">Mois invalide</div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="card-expiry-year" name="card-expiry-year" placeholder="AA" maxlength="2">
                                        <div class="validation-error" id="year-error">Année invalide</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-cvc">CVC</label>
                                <input type="text" id="card-cvc" name="card-cvc" placeholder="123" maxlength="3">
                                <div class="validation-error" id="cvc-error">CVC invalide</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit-button" disabled>
                        <i class="fas fa-check-circle"></i>
                        Confirmer Votre Commande
                    </button>
                @endif
            </form>
            <div class="auth-links mt-6 text-center">
                <a href="/" class="text-orange-500 hover:text-orange-600 transition duration-300">Confirmer Plud Tard ? Retour Acceuill</a>
            </div>
        </div>
        
    </div>

    <script>


        document.addEventListener('DOMContentLoaded', function() {
            const cashPayment = document.getElementById('cash-payment');
            const cardPayment = document.getElementById('card-payment');
            const cashMethod = document.getElementById('cash-method');
            const cardMethod = document.getElementById('card-method');
            const creditCardForm = document.getElementById('credit-card-form');
            const submitButton = document.getElementById('submit-button');

            // Form fields
            const cardName = document.getElementById('card-name');
            const cardNumber = document.getElementById('card-number');
            const cardExpiryMonth = document.getElementById('card-expiry-month');
            const cardExpiryYear = document.getElementById('card-expiry-year');
            const cardCVC = document.getElementById('card-cvc');

            // Error elements
            const nameError = document.getElementById('name-error');
            const numberError = document.getElementById('number-error');
            const monthError = document.getElementById('month-error');
            const yearError = document.getElementById('year-error');
            const cvcError = document.getElementById('cvc-error');

            // Toggle payment method selection
            cashMethod.addEventListener('click', function() {
                cashPayment.checked = true;
                updatePaymentMethod();
            });

            cardMethod.addEventListener('click', function() {
                cardPayment.checked = true;
                updatePaymentMethod();
            });

            cashPayment.addEventListener('change', updatePaymentMethod);
            cardPayment.addEventListener('change', updatePaymentMethod);

            // Format card number with spaces
            cardNumber.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = '';

                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formattedValue += ' ';
                    }
                    formattedValue += value[i];
                }

                e.target.value = formattedValue;
            });

            // Input validation
            cardName.addEventListener('input', validateForm);
            cardNumber.addEventListener('input', validateForm);
            cardExpiryMonth.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/gi, '');
                e.target.value = value;
                validateForm();
            });
            cardExpiryYear.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/gi, '');
                e.target.value = value;
                validateForm();
            });
            cardCVC.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/gi, '');
                e.target.value = value;
                validateForm();
            });

            function updatePaymentMethod() {
                // Update UI for payment method selection
                if (cashPayment.checked) {
                    cashMethod.classList.add('active');
                    cardMethod.classList.remove('active');
                    creditCardForm.style.display = 'none';
                    submitButton.disabled = false;
                } else {
                    cashMethod.classList.remove('active');
                    cardMethod.classList.add('active');
                    creditCardForm.style.display = 'block';
                    validateForm();
                }
            }

            function validateForm() {
                if (!cardPayment.checked) return;

                let isValid = true;

                // Validate name (at least 3 characters)
                if (!cardName.value || cardName.value.trim().length < 3) {
                    nameError.style.display = 'block';
                    isValid = false;
                } else {
                    nameError.style.display = 'none';
                }

                // Validate card number (at least 16 digits)
                const cardNumberValue = cardNumber.value.replace(/\s+/g, '');
                if (!cardNumberValue || cardNumberValue.length < 16) {
                    numberError.style.display = 'block';
                    isValid = false;
                } else {
                    numberError.style.display = 'none';
                }

                // Validate expiry month (01-12)
                const monthValue = parseInt(cardExpiryMonth.value, 10);
                if (isNaN(monthValue) || monthValue < 1 || monthValue > 12) {
                    monthError.style.display = 'block';
                    isValid = false;
                } else {
                    monthError.style.display = 'none';
                }

                // Validate expiry year (current year or future)
                const yearValue = parseInt(cardExpiryYear.value, 10);
                const currentYear = new Date().getFullYear() % 100; // Get last 2 digits
                if (isNaN(yearValue) || yearValue < currentYear) {
                    yearError.style.display = 'block';
                    isValid = false;
                } else {
                    yearError.style.display = 'none';
                }

                // Validate CVC (3 digits)
                if (!cardCVC.value || cardCVC.value.length !== 3) {
                    cvcError.style.display = 'block';
                    isValid = false;
                } else {
                    cvcError.style.display = 'none';
                }

                // Update submit button state
                submitButton.disabled = !isValid;
            }


            updatePaymentMethod();
        });
    </script>

</body>
</html>
