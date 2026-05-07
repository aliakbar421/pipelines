<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Test - PhotoShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">PhotoShare REST API Tester</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>GET /api/photos - Get All Photos</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" onclick="testGetPhotos()">Test Endpoint</button>
                <pre id="result-photos" class="mt-3 bg-light p-3" style="max-height: 400px; overflow-y: auto;"></pre>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>GET /api/photos/search - Search Photos</h5>
            </div>
            <div class="card-body">
                <input type="text" id="searchQuery" class="form-control mb-2" placeholder="Enter search term">
                <button class="btn btn-primary" onclick="testSearch()">Test Search</button>
                <pre id="result-search" class="mt-3 bg-light p-3" style="max-height: 400px; overflow-y: auto;"></pre>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>GET /api/photos/{id} - Get Single Photo</h5>
            </div>
            <div class="card-body">
                <input type="number" id="photoId" class="form-control mb-2" placeholder="Enter photo ID" value="1">
                <button class="btn btn-primary" onclick="testGetPhoto()">Test Endpoint</button>
                <pre id="result-photo" class="mt-3 bg-light p-3" style="max-height: 400px; overflow-y: auto;"></pre>
            </div>
        </div>
    </div>

    <script>
        async function testGetPhotos() {
            const result = document.getElementById('result-photos');
            result.textContent = 'Loading...';
            
            try {
                const response = await fetch('/api/photos');
                const data = await response.json();
                result.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                result.textContent = 'Error: ' + error.message;
            }
        }

        async function testSearch() {
            const query = document.getElementById('searchQuery').value;
            const result = document.getElementById('result-search');
            result.textContent = 'Loading...';
            
            try {
                const response = await fetch(`/api/photos/search?q=${encodeURIComponent(query)}`);
                const data = await response.json();
                result.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                result.textContent = 'Error: ' + error.message;
            }
        }

        async function testGetPhoto() {
            const id = document.getElementById('photoId').value;
            const result = document.getElementById('result-photo');
            result.textContent = 'Loading...';
            
            try {
                const response = await fetch(`/api/photos/${id}`);
                const data = await response.json();
                result.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                result.textContent = 'Error: ' + error.message;
            }
        }
    </script>
</body>
</html>