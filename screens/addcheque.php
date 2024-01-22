<?php
include("../head.inc.php");
$queryMgr = new querymanager();
$currentData = $queryMgr->getCurrentFuelStatus()[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Godfrey/Add Cheque</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand font-weight-bold text-white" style="text-shadow: 2px 2px 4px #000000;" href="#">Godfrey Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="allreports">All Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lastupdate">Last Update</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dayend">Day End</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pricechange">Price Change</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Delivery<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chequereport">Cheque Report</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <div class="container mt-3">
        <h3 class="text-center">Add Cheque</h3>
        <hr>
        <div class="container">
            <form autocomplete="off" action="controllers/fuel_controller.php" method="post">
                <datalist id="payees">
                    <option value="W.O. Stinson & Son Ltd.">
                    <option value="The Beer Store">
                    <option value="TCO Agromart">
                    <option value="Coca Cola Canada">
                    <option value="Pepsico Canada">
                    <option value="Pab Wholesaler Inc.">
                    <option value="Jo-Anne Conner">
                    <option value="Tony Ferrusi">
                    <option value="Scholtens Inc.">
                    <option value="Denvil Distribution">
                    <option value="Blue Mountain Dist.">
                    <option value="Les Appats Ste-Martine Inc.">
                    <option value="Robinson Ice">
                    <option value="Mihir Panchal">
                    <option value="Parthkumar Patel">
                    <option value="Snehalben Patel">
                    <option value="Himanshu Patel">
                    <option value="Yash Patel">
                    <option value="Preksha Patel">
                    <option value="Aashka Shah">
                </datalist>
                <input type="hidden" name="action" value="addCheque">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Cheque #</span>
                            </div>
                            <input type="number" name="cheque_number" class="form-control" step="1" id="" placeholder="####" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Date On Cheque</span>
                            </div>
                            <input type="date" name="cheque_date" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Amount</span>
                            </div>
                            <input type="number" name="cheque_amount" class="form-control" id="" placeholder="$" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">To</span>
                            </div>
                            <input type="text" name="cheque_given_to" class="form-control" list="payees" id="" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Given By</span>
                            </div>
                            <select class="form-control" name="cheque_given_by" id="">
                                <option value="Mihir">Mihir</option>
                                <option value="Krushap">Krushap</option>
                                <option value="Rumeshbhai">Rumeshbhai</option>
                                <option value="Yash">Yash</option>
                                <option value="Preksha">Preksha</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Given On</span>
                            </div>
                            <input type="date" name="cheque_given_date" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend3">Note</span>
                            </div>
                            <input type="text" name="note" class="form-control" id="" required>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <hr>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>