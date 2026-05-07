# PhotoShare REST API Documentation

Base URL: `http://localhost:8000/api`

---

## Public Endpoints (No Authentication Required)

### 1. Get All Photos
```http
GET /api/photos
GET /api/photos?per_page=20
```

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "title": "Sunset at Beach",
        "caption": "Beautiful sunset view",
        "location": "Malibu, CA",
        "people": "John, Sarah",
        "image_path": "photos/xxx.jpg",
        "avg_rating": 4.5,
        "rating_count": 10,
        "comments_count": 5,
        "user": {
          "id": 1,
          "name": "John Doe",
          "email": "john@example.com",
          "role": "creator"
        },
        "created_at": "2026-05-03T10:00:00.000000Z"
      }
    ],
    "total": 50
  }
}
```

### 2. Get Single Photo
```http
GET /api/photos/{id}
```

### 3. Search Photos
```http
GET /api/photos/search?q=sunset
GET /api/photos/search?q=beach&per_page=10
```

---

## Protected Endpoints (Require Authentication)

**Authentication:** Use Laravel Sanctum tokens

### Generate Token (Login)
First, create a login endpoint or use Laravel's built-in authentication.

### 4. Create Photo (Creator Only)
```http
POST /api/photos
Content-Type: multipart/form-data
Authorization: Bearer {your_token}

Fields:
- title (required)
- caption (optional)
- location (optional)
- people (optional)
- image (required, file)
```

### 5. Update Photo (Creator Only, Own Photos)
```http
PUT /api/photos/{id}
Authorization: Bearer {your_token}

Fields:
- title
- caption
- location
- people
- image (optional)
```

### 6. Delete Photo (Creator Only, Own Photos)
```http
DELETE /api/photos/{id}
Authorization: Bearer {your_token}
```

### 7. Add Comment
```http
POST /api/photos/{id}/comments
Authorization: Bearer {your_token}
Content-Type: application/json

{
  "body": "Amazing photo!"
}
```

### 8. Rate Photo
```http
POST /api/photos/{id}/rate
Authorization: Bearer {your_token}
Content-Type: application/json

{
  "score": 5
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "rating": {
      "id": 1,
      "user_id": 2,
      "photo_id": 1,
      "score": 5
    },
    "photo_avg_rating": 4.5,
    "photo_rating_count": 10
  },
  "message": "Rating submitted successfully"
}
```

---

## Error Responses

### Validation Error (422)
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "title": ["The title field is required."]
  }
}
```

### Not Found (404)
```json
{
  "success": false,
  "message": "Photo not found"
}
```

### Unauthorized (403)
```json
{
  "success": false,
  "message": "Unauthorized action"
}
```

### Unauthenticated (401)
```json
{
  "message": "Unauthenticated."
}
```

---

## Testing with Postman/cURL

### Example cURL Request:
```bash
# Get all photos
curl http://localhost:8000/api/photos

# Search photos
curl "http://localhost:8000/api/photos/search?q=sunset"

# Get single photo
curl http://localhost:8000/api/photos/1
```