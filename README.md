
#  Fidelity Point Card - API
API built for Fidelity Point Card - Mobile App.
All requests (except registration and authentication) use the POST method and go through the API's gateway service which can manage multiple requests at once.
All objects can be auto generated from the Entity folder to Dart and TypeScript with the commands 'fidelity:dart:entities' and 'fidelity:js:entities'. 
All gateway routes are auto generated on every migration in both Dart and TypeScript.

## API Reference - Account

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


#### Edit account data

```http
  POST /accountData/edit
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `account` | `AccountQuickRegistrationDTO` | **Required**. Edited account |
| `token` | `string` | **Required**. API token |


#### Create subaccount

```http
  POST /subaccount/create
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `mainAccountId` | `string` | **Required**. User account ID |
| `chosenAccountId` | `string` | **Required**. ID of the account the user is sharing his own card to |
| `token` | `string` | **Required**. API token |


#### Fetch all subaccounts

```http
  POST /allsubaccounts/get
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `accountId` | `string` | **Required**. Account ID |
| `token` | `string` | **Required**. API token |


#### Cancel subaccount

```http
  POST /subaccount/cancel
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `mainAccountId` | `string` | **Required**. User account ID |
| `chosenAccountId` | `string` | **Required**. ID of the account the user has previously shared his own card to before |
| `token` | `string` | **Required**. API token |

## API Reference - Transactions

#### Get all transaction records

```http
  POST /alltransactionrecords/get
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `accountId` | `string` | **Required**. User account ID |
| `itemsToLoad` | `int` | **Required**. Pagination quantity |
| `firstItem` | `int` | **Required**. Pagination's first item |
| `type` | `int` | **Required**. Transaction type. 1 = purchases, -1 = exchanges, 0 = all |
| `token` | `string` | **Required**. API token |

#### Get all transaction records

```http
  POST /pointssum/get
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `accountId` | `string` | **Required**. User account ID |
| `token` | `string` | **Required**. API token |




