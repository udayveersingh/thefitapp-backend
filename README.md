# Introduction

The Fit App Backend was built with Laravel, from the ground-up with a REST API that makes it easy for developers and sysadmins to interchange the data.

These docs describe how to use the [TheFitApp](http://thefitapp.60dweb.com/) API. We hope you enjoy these docs, and please don't hesitate to [file an issue](https://github.com/udayveersingh/thefitapp-backend/issues/new) if you see anything missing.


## Authorization

For Authorization, every user has to be registered on our web application. Developers can integarte the Register and Login API in their mobile apps to let thier users access the features.

To authenticate an user, you should first call the `Register` API endpoint.

You should send the request body in `JSON` that will have the details of the user. 

```http
POST http://thefitapp.60dweb.com/api/auth/register
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `name` | `string` | **Required**. User Full Name |
| `email` | `string` | **Required**. User Email Address |
| `phone` | `number` | **Required**. User Phone Number |
| `referral_code` | `string` | **Optional**. Referral Code, if have any |

## Responses

Many API endpoints return the JSON representation of the resources created or edited. However, if an invalid request is submitted, or some other error occurs, Gophish returns a JSON response in the following format:

```javascript
{
  "message" : string,
  "success" : bool,
  "data"    : string
}
```

The `message` attribute contains a message commonly used to indicate errors or, in the case of deleting a resource, success that the resource was properly deleted.

The `success` attribute describes if the transaction was successful or not.

The `data` attribute contains any other metadata associated with the response. This will be an escaped string containing JSON data.

## Status Codes

API returns the following status codes in its API:

| Status Code | Description |
| :--- | :--- |
| 200 | `OK` |
| 201 | `CREATED` |
| 400 | `BAD REQUEST` |
| 401 | `UNAUTHORIZED` |
| 404 | `NOT FOUND` |
| 500 | `INTERNAL SERVER ERROR` |