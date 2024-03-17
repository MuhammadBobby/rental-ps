<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Reports</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      color: #333;
    }

    h1 {
      font-size: 3rem;
      text-align: center;
      color: #4caf50;
    }

    p {
      text-align: center;
      font-size: 0.8rem;
      color: #3333339f;
      margin-top: -10px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      text-align: center;
      padding: 8px;
    }

    th {
      background-color: #4caf50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }
  </style>
</head>

<body>
  <h1>Booking Reports</h1>
  <p>This is an example of a booking report.</p>
  <hr />

  <table>
    <tr>
      <th>No</th>
      <th>Member</th>
      <th>Staff</th>
      <th>Duration</th>
      <th>Type Playstation</th>
      <th>Booking Date</th>
      <th>Total Price</th>
    </tr>

    <?php
    $num = 1;
    foreach ($booking as $bk) :
    ?>
      <tr>
        <td><?= $num++ ?></td>
        <td><?= $bk['NamaMember'] ?></td>
        <td><?= $bk['NamaStaff'] ?></td>
        <td><?= $bk['Durasi'] ?> Jam</td>
        <td><?= $bk['NamaBarang'] ?></td>
        <td><?= date_format(date_create($bk['TanggalPemesanan']), 'd-m-Y'); ?></td>
        <td>Rp. <?= $bk['TotalBiaya'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>