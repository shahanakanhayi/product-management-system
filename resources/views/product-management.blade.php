<!DOCTYPE html>
<html>
<head>
    <title>Product Management System</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
        }
        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <h2 class="text-center mb-5">📦 Product Management System</h2>

    <div class="row g-4">

        <!-- Product -->
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h5 class="section-title">Create Product</h5>
                <form method="POST" action="/product">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
                    <input type="text" name="code" class="form-control mb-2" placeholder="Code / SKU" required>
                    <input type="number" name="price" class="form-control mb-3" placeholder="Price" required>
                    <button class="btn btn-primary w-100">Save Product</button>
                </form>
            </div>
        </div>

        <!-- Warehouse -->
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h5 class="section-title">Create Warehouse</h5>
                <form method="POST" action="/warehouse">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" placeholder="Warehouse Name" required>
                    <input type="text" name="location" class="form-control mb-3" placeholder="Location" required>
                    <button class="btn btn-success w-100">Save Warehouse</button>
                </form>
            </div>
        </div>

        <!-- Store -->
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h5 class="section-title">Create Store</h5>
                <form method="POST" action="/store">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" placeholder="Store Name" required>
                    <input type="text" name="location" class="form-control mb-3" placeholder="Location" required>
                    <button class="btn btn-warning w-100">Save Store</button>
                </form>
            </div>
        </div>

        <!-- Add Stock -->
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h5 class="section-title">Add Stock to Warehouse</h5>
                <form method="POST" action="/warehouse/add-stock">
                    @csrf
                    <input type="number" name="product_id" class="form-control mb-2" placeholder="Product ID" required>
                    <input type="number" name="warehouse_id" class="form-control mb-2" placeholder="Warehouse ID" required>
                    <input type="number" name="quantity" class="form-control mb-3" placeholder="Quantity" required>
                    <button class="btn btn-dark w-100">Add Stock</button>
                </form>
            </div>
        </div>

        <!-- Transfer -->
        <div class="col-12">
            <div class="card shadow p-4">
                <h5 class="section-title">Transfer Stock (Warehouse → Store)</h5>
                <form method="POST" action="/transfer">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="number" name="product_id" class="form-control" placeholder="Product ID" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="number" name="warehouse_id" class="form-control" placeholder="Warehouse ID" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="number" name="store_id" class="form-control" placeholder="Store ID" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                        </div>
                    </div>
                    <button class="btn btn-danger w-100 mt-2">Transfer Stock</button>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>