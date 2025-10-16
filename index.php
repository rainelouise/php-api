<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Classic Pinoy Snacks</title>
  <style>
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(180deg, #fff7e6 0%, #fff1cc 100%);
      text-align: center;
      padding: 40px 20px;
      color: #3a2e19;
    }

    h1 {
      font-size: 2.5em;
      color: #d84315;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    p {
      color: #5c4632;
      font-size: 1.05em;
      margin-bottom: 40px;
    }

    .snack-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 35px;
    }

    .snack {
      background: #fffdf7;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      padding: 20px;
      width: 300px;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      border: 2px solid #f5d28b;
    }

    .snack:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .snack img {
      width: 100%;
      border-radius: 12px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    h3 {
      font-size: 1.25em;
      color: #c0392b;
      margin-bottom: 10px;
    }

    input {
      padding: 10px;
      margin: 8px 0;
      width: 85%;
      border: 1px solid #d4b483;
      border-radius: 8px;
      background: #fffaf0;
      font-size: 1em;
      transition: border-color 0.3s;
    }

    input:focus {
      border-color: #f57c00;
      outline: none;
    }

    button {
      background: linear-gradient(135deg, #f57c00, #ef6c00);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      font-size: 1em;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: linear-gradient(135deg, #ff9800, #f57c00);
      transform: scale(1.03);
    }

    .result {
      margin-top: 10px;
      font-weight: 600;
      min-height: 25px;
    }

    header {
      background: repeating-linear-gradient(
        45deg,
        #f57c00,
        #f57c00 10px,
        #ffcc80 10px,
        #ffcc80 20px
      );
      height: 6px;
      border-radius: 6px;
      width: 80%;
      margin: 0 auto 20px auto;
    }
  </style>
</head>
<body>

  <header></header>
  <h1>Classic Pinoy Snacks</h1>
  <p>Relive your childhood favorites — crunchy, sweet, and full of memories!</p>

  <div class="snack-container">
    <div class="snack">
      <img src="https://ph.all.biz/img/ph/catalog/10588.jpeg" alt="Nooda Crunch">
      <h3>Nooda Crunch — ₱15 each</h3>
      <form class="snack-form" data-snack="Nooda Crunch" data-price="15">
        <input type="number" name="cash" placeholder="Enter cash" step="0.01"><br>
        <input type="number" name="quantity" placeholder="Enter quantity"><br>
        <button type="submit">Buy Now</button>
      </form>
      <div class="result"></div>
    </div>

    <div class="snack">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-EiWYXvcRYKQ4RYl8hnqxPte86orjJGDMylXBdAE5j6pHoqWPoI4PFmxPMFSo_nFvyvE&usqp=CAU" alt="Nestle Pops">
      <h3>Nestle Pops — ₱25 each</h3>
      <form class="snack-form" data-snack="Nestle Pops" data-price="25">
        <input type="number" name="cash" placeholder="Enter cash" step="0.01"><br>
        <input type="number" name="quantity" placeholder="Enter quantity"><br>
        <button type="submit">Buy Now</button>
      </form>
      <div class="result"></div>
    </div>

    <div class="snack">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1UpE97LL0mkty88ZYBruN32kCuwCNUPlz7A&s" alt="Payless Pancit Shanghai">
      <h3>Payless Pancit Shanghai — ₱20 each</h3>
      <form class="snack-form" data-snack="Payless Pancit Shanghai" data-price="20">
        <input type="number" name="cash" placeholder="Enter cash" step="0.01"><br>
        <input type="number" name="quantity" placeholder="Enter quantity"><br>
        <button type="submit">Buy Now</button>
      </form>
      <div class="result"></div>
    </div>
  </div>

  <script>
    const forms = document.querySelectorAll('.snack-form');
    forms.forEach(form => {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const cash = form.querySelector('input[name="cash"]').value;
        const quantity = form.querySelector('input[name="quantity"]').value;
        const snack = form.dataset.snack;
        const price = form.dataset.price;
        const resultDiv = form.nextElementSibling;

        const response = await fetch('api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ snack, price, cash, quantity })
        });

        const data = await response.json();

        if (data.success) {
          resultDiv.style.color = '#2e7d32';
          resultDiv.textContent = `Transaction successful! Your change: ₱${data.change.toFixed(2)}`;
        } else {
          resultDiv.style.color = '#c62828';
          resultDiv.textContent = `${data.message}`;
        }
      });
    });
  </script>
</body>
</html>