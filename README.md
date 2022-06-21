
## API Reference

#### Register new Account

```http
  POST /api/mobile/account/auth/create
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `authData` | `AccountQuickRegistrationDTO` | **Required**. Account registration DTO |

#### Log in

```http
  POST /api/mobile/account/auth/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `username` | `string` | **Required**. Username |
| `password` | `string` | **Required**. Password |
| `token` | `string` | **Required**. API token if available |


