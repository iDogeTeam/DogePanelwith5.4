# Web 用 API

编写文档时请参照以下的example.

-----

# `/login`

Login

## Request
 
 * Method : `POST`
 
 * Extra header
   
   1. `Accept:application/json`
   
   2. `content-type:application/json; charset=utf-8`
   
 * POST data will be like that
  
  ```json
  {
    "email": "xxx@xxx.com",
    "pass": "xxxxxx",
    "remember": "false"
  }
  ```
 
If you want to set `content-type` as `application/x-www-form-urlencoded`. POST data will be a string like `email=xxx%40xxx.com&pass=xxxxxx&remember=false`.
 
## Response

### login success

```json
{}
```

### login failed

```json
{
    "error_code": "400"
}
```
