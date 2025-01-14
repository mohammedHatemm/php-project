<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Table Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color:#adb5bd;
        }

        .navbar {
            background-color: #87CEEB;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar a {
            color: #ffffff;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .admin-icon {
            display: flex;
            align-items: center;
            color: #ffffff;
            font-size: 0.9rem;
            text-align: center;
        }

        .admin-icon i {
            margin-left: 10px;
            cursor: pointer;
        }

        .section {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: rgb(69, 161, 210);
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #87CEEB;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        thead th {
            padding: 15px;
            text-align: center;
        }

        tbody tr {
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background-color: #f0f8ff;
        }

        tbody td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .status {
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
        }

        .status.processing {
            color: #537aa1;
        }

        .status.completed {
            color: #345a7c;
        }

        .status.deleted {
            color: #7c8a96;
        }

        .action-icons i {
            cursor: pointer;
            margin-right: 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .action-icons i:hover {
            color: #345a7c;
            transform: scale(1.2);
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#">Manual Order</a>
        <a href="#">Checks</a>
    </div>
    <div class="admin-icon">
    <i class="bi bi-person-circle" style="font-size: 1.5rem; margin-right: 5px;"></i>
        <span>Admin</span>
        <div class="logout" style="display: flex; align-items: center; margin-left: 15px; cursor: pointer;">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 5px;"></i>
            <span>Log out</span>
    </div>
</nav>

<div class="container py-5">

    <!-- Section 1: Filters -->
    <div class="section">
        <h2 class="section-title">Checks</h2>
        <form>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="dateFrom" class="form-label">Date From</label>
                    <input type="date" id="dateFrom" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="dateTo" class="form-label">Date To</label>
                    <input type="date" id="dateTo" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="userSelect" class="form-label">User</label>
                    <select id="userSelect" class="form-select">
                        <option value="">Select User</option>
                        <!-- Replace with dynamic users -->
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Section 2: Orders -->
    <div class="section">
        <h2 class="section-title">Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>rawda</td>
                    <td>- Coffee (50 EGP)</td>
                    <td>50 EGP</td>
                    <td>2025-01-13 10:30 AM</td>
                    <td class="status processing">
                        <i class="bi bi-arrow-repeat"></i> Processing
                    </td>
                    <td class="action-icons">
                        
                        <i class="bi bi-pencil" title="Edit"></i>
                        <i class="bi bi-trash" title="Delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>mostafa</td>
                    <td>- tea (30 EGP)</td>
                    <td>30 EGP</td>
                    <td>2025-01-13 10:30 AM</td>
                    <td class="status processing">
                        <i class="bi bi-arrow-repeat"></i> Processing
                    </td>
                    <td class="action-icons">
                        
                        <i class="bi bi-pencil" title="Edit"></i>
                        <i class="bi bi-trash" title="Delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>menna</td>
                    <td>- Cappuccino (60 EGP)</td>
                    <td>60 EGP</td>
                    <td>2025-01-12 11:00 AM</td>
                    <td class="status completed">
                        <i class="bi bi-check-circle"></i> Completed
                    </td>
                    <td class="action-icons">
                        
                        <i class="bi bi-pencil" title="Edit"></i>
                        <i class="bi bi-trash" title="Delete"></i>
                    </td>
                </tr>
                <tr>
                    <td>mohamed</td>
                    <td>- Espresso (40 EGP)</td>
                    <td>40 EGP</td>
                    <td>2025-01-11 09:15 AM</td>
                    <td class="status deleted">
                        <i class="bi bi-trash"></i> Deleted
                    </td>
                    <td class="action-icons">
                        
                        <i class="bi bi-pencil" title="Edit"></i>
                        <i class="bi bi-trash" title="Delete"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
