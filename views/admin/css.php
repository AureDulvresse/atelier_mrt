<style>
    body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
        }

        .main-content {
            margin-left: 270px; /* Ajuster en fonction de la largeur de la sidebar et de son padding */
            padding: 20px;
            background-color: #f8f9fa;
            width: calc(100% - 270px); /* Ajuster en fonction de la largeur de la sidebar et de son padding */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-title h1 {
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info p {
            margin: 0 10px 0 0;
        }

        .user-info img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-box {
            flex: 1;
            background-color: white;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 0 10px;
        }

        .stat-box p {
            font-size: 24px;
            margin: 0;
        }

        .visitor-table {
            margin-top: 20px;
        }

        .status {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #28a745; /* Couleur pour les visiteurs checkés */
        }
        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-item {
            cursor: pointer;
        }

        .page-item.disabled .page-link {
            pointer-events: none;
        }

        .page-item.active .page-link {
            background-color: #010a12;
            border-color: #010a12;
        }

        .page-link {
            color: #010a12;
        }
</style>