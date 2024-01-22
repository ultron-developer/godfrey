<?php
include("../head.inc.php");
$cheque_id = $_GET['chequeid'];
$queryMgr = new querymanager();
$cheque_details = $queryMgr->getChequeDetailsById($cheque_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godfrey/Cheque information</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand font-weight-bold text-white" style="text-shadow: 2px 2px 4px #000000;" href="#">Godfrey Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <a class="nav-link f-right" href="delivery">Back</a> -->
</nav>

<body>
    <div class="container mt-3 text-center">
        <h3 class="text">Confirm The Details</h3>
        <hr>
        <h5>Cheque #<?php echo $cheque_details["cheque_number"] ?></h5>
        <h5>Date On Cheque : <?php echo date("M jS, Y", strtotime($cheque_details["cheque_date"])) ?></h5>
        <h5>Amount : <?php echo $cheque_details["cheque_amount"] ?></h5>
        <h5>To : <?php echo $cheque_details["cheque_given_to"] ?></h5>
        <p>Given By : <?php echo $cheque_details["cheque_given_by"] . " on " . date("M jS, Y", strtotime($cheque_details["cheque_given_date"])) ?></p>
        <hr>
        <div class="container text-center">
            <form action="controllers/fuel_controller.php" method="post">
                <input type="hidden" name="action" value="depositTheCheque">
                <input type="hidden" name="cheque_id" value="<?php echo $cheque_details["id"]?>">
                <div class="input-group mx-auto" style="max-width: 150px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">Pin</span>
                    </div>
                    <input type="number" id="code" name="cheque_number" class="form-control" step="1" id="" oninput="CodeVaerification()" required>
                </div>
                <a class="btn btn-danger mt-2 text-white" href="chequereport">Cancel</a>
                <button id="deposit_btn" class="btn btn-success mt-2" type="submit" disabled>Mark as Deposited</button>
            </form>
        </div>
    </div>
</body>

<script>
    function CodeVaerification() {
        var code, deposit_btn;
        code = document.getElementById("code").value;
        if (code == 8111) {
            document.getElementById("deposit_btn").disabled = false;
        }else {
            document.getElementById("deposit_btn").disabled = true;
        }
    };
</script>

</html>