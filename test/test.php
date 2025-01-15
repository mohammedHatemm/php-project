<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products List</h1>
    <ul id="products"></ul>

    <script>
        fetch("http://localhost/apis/get_products.php")
            .then(response => response.json())
            .then(data => {
                const productsList = document.getElementById('products');
                data.forEach(product => {
                    const li = document.createElement('li');
                    li.textContent = `${product.name} - $${product.price}`;
                    productsList.appendChild(li);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>
