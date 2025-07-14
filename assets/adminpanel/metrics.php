<head>
    <style>
        .metrics-container{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5rem;
            margin-top: 20px;
        }
        .card-main{
            /* background-color: green; */
            width: 200px;
            height: 180px;
            text-align: center;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            border-radius: 20px;
        }
        .card{
            align-items: center;
            justify-content: center;
            margin: auto;
        }
        .bg-1{
            background-color: #754E1A;
        }
        .bg-2{
            background-color: #CBA35C;
        }
        .bg-3{
            background-color: #808836;
        }
        .bg-4{
            background-color: #704264;
        }
    </style>
</head>

<!-- Metrics -->
<div class="metrics-container">
    <div class="card-main bg-1">
        <div class="card">
            <div class="card-body">
                <h5>Total Products</h5>
                <p class="fs-3"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products")) ?></p>
            </div>
        </div>
    </div>
    <div class="card-main bg-2">
        <div class="card">
                <h5>Total Orders</h5>
                <p class="fs-3"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM orders")) ?></p>
        </div>
    </div>
    <div class="card-main bg-3">
        <div class="card">
                <h5>Total Users</h5>
                <p class="fs-3"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users")) ?></p>
        </div>
    </div>
    <div class="card-main bg-4">
        <div class="card">
                <h5>Total Views</h5>
                <p class="fs-3">
                    <?php
                    $viewRes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(view_count) as total FROM page_views"));
                    echo $viewRes['total'] ?? 0;
                    ?>
                </p>
        </div>
    </div>
</div>