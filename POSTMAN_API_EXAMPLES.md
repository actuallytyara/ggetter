# Postman API Examples (Laravel Sanctum Bearer Token)

Base URL: `http://localhost:8000`

## 1) Login (get token)
**POST** `/api/login`

> Endpoint ini mengembalikan `access_token` untuk dipakai di header `Authorization: Bearer ...`



### Body (raw JSON)
```json
{
  "email": "your_email@example.com",
  "password": "your_password"
}
```

### Response (example)
```json
{
  "status": "✅ Success",
  "message": "Login berhasil",
  "access_token": "<TOKEN>",
  "token_type": "Bearer"
}
```

> Copy `access_token`.

## 2) Set Header (for all below)
Add header:
- `Authorization: Bearer <TOKEN>`
- `Content-Type: application/json`

---

## TASKS

### GET `/api/tasks`
**GET** `/api/tasks`

### POST `/api/tasks`
**POST** `/api/tasks`

Body:
```json
{
  "judul": "Morning run",
  "tanggal": "2026-06-10",
  "priority": "high",
  "status": "pending",
  "goal_id": 1,
  "habit_id": 1
}
```

### PUT `/api/tasks/{id}`
**PUT** `/api/tasks/1`

Body:
```json
{
  "status": "completed",
  "progress": "not_used_here"
}
```

### DELETE `/api/tasks/{id}`
**DELETE** `/api/tasks/1`

---

## GOALS

### GET `/api/goals`
**GET** `/api/goals`

### POST `/api/goals`
**POST** `/api/goals`

Body:
```json
{
  "title": "Get fit",
  "category": "Health",
  "description": "Improve stamina",
  "progress": 10
}
```

### PUT `/api/goals/{id}`
**PUT** `/api/goals/1`

Body:
```json
{
  "progress": 35,
  "title": "Get really fit"
}
```

### DELETE `/api/goals/{id}`
**DELETE** `/api/goals/1`

---

## HABITS

### GET `/api/habits`
**GET** `/api/habits`

### POST `/api/habits`
**POST** `/api/habits`

Body:
```json
{
  "nama": "Drink water",
  "frekuensi": "daily",
  "status": "active"
}
```

### PUT `/api/habits/{id}`
**PUT** `/api/habits/1`

Body:
```json
{
  "status": "inactive"
}
```

### DELETE `/api/habits/{id}`
**DELETE** `/api/habits/1`


