<?php
session_start();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

include "includes/header.php";
include "includes/head.php";
include "includes/footer.php";

if (!isset($_SESSION['passenger_details'])) {
    header("Location: pass_form.php");
    exit();
}
if (isset($_POST['passenger_count'])) {
    $passenger_count = (int)$_POST['passenger_count'];
    $flight_id = $_POST['flight_id'] ?? '';
    $price = $_POST['price'] ?? '';
    $class = $_POST['class'] ?? '';
}
?>

<style>
  .gradient-custom {
    background-blend-mode: screen, color-dodge, overlay, difference, normal;
  }

  .card {
    border-radius: 15px;
  }

  .form-control-lg {
    height: 50px; /* Adjust the height of form controls */
  }

  .btn-primary {
    width: 75px;
    height: 50px; /* Adjust the height of the button */
    font-size: 12px; /* Adjust the font size of the button text */
  }
</style>

<h1 class="col-12 text-center">Payment</h1>
<section class="gradient-custom">
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-12 mb-4"></div>
        </div>
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-7 col-lg-5 col-xl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <form method="post" action="payment_process.php">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                            <div class="form-outline">
                                <input type="text" name="card_no" id="card_no" class="form-control form-control-lg"
                                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required />
                                <label class="form-label" for="card_no">Card Number</label>
                            </div>
                                <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa" width="64px" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-outline">
                                    <input type="text" name="cardholder_name" class="form-control form-control-lg"
                                        placeholder="Cardholder's Name" required />
                                    <label class="form-label" for="cardholder_name">Cardholder's Name</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <div class="form-outline">
                                    <input type="text" name="expiration" class="form-control form-control-lg"
                                        placeholder="MM/YYYY" size="7" minlength="7" maxlength="7" required />
                                    <label class="form-label" for="expiration">Expiration</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" name="cvv" class="form-control form-control-lg"
                                        placeholder="&#9679;&#9679;&#9679;" size="3" minlength="3" maxlength="3" required />
                                    <label class="form-label" for="cvv">CVV</label>
                                </div>
                            </div>

                            <!-- Hidden inputs for flight_id and user_id -->
                            <input type="hidden" name="price" value="<?= $price ?>">
                            <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">

                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('card_no').addEventListener('input', function (e) {
        let target = e.target;
        let input = target.value.replace(/\D/g, '').substring(0, 16);
        let formatted = input.replace(/(\d{4})/g, '$1 ').trim();
        target.value = formatted;
    });
</script>

<?php include "includes/footer.php"; ?>
