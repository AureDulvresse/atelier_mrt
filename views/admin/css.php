<style>
    body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
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