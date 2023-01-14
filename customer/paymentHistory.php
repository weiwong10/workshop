<?php
include "../connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div>

<table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">Payment ID</th>
      <th scope="col">Payment Date</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select paymentID,payment_date,amount from payment";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $paymentID = $row['paymentID'];
            $payment_date = $row['payment_date'];
            $amount = $row['amount'];
            echo '<tr>
            <th scope="row">'.$paymentID.'</th>
            <td>'.$payment_date.'</td>
            <td>' .$amount.'</td>
            <td>
            </td>
          </tr>';
        }
    }

    
    ?>
  </tbody>
</table>
</div>
</body>
</html>