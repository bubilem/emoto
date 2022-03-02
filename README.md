# EMOTO API

**School EMOTO project.**

---

## ECHO

For testing

### **Request**

URL:

```
{server_url}/echo
```

POST:

```
{
    "dttm": "2022-02-20 13:45:50",
    "vehicle_code": "ZIDAN",
    "message": "Hello",
    "signature": "this-is-40hexadigits-signature"
}
```

### **Reply**

```
{
    "dttm": "2022-02-20 13:45:51",
    "vehicle_code": "ZIDAN",
    "message": "Hello",
    "status_key": 0,
    "status_mess": "OK",
    "signature": "this-is-40hexadigits-signature"
}
```

---

## ADD LOG

Add log to store in database

### **Request**

URL:

```
{server_url}/add-log
```

POST:

```
{
    "dttm": "2022-02-20 13:45:50",
    "vehicle_code": "ZIDAN",
    "mileage": "5",
    "battery_capacity": "48",
    "gps": "50.9128308N, 14.6171558E",
    "signature": "this-is-40hexadigits-signature"
}
```

### **Reply**

```
{
    "dttm":"2022-02-20 13:45:51",
    "status_key": 10,
    "status_mess": "Log saved",
    "signature": "this-is-40hexadigits-signature"
}
```

---

## GET LAST LOG

Get last log from database

### **Request**

URL:

```
{server_url}/get-last-log
```

POST:

```
{
    "dttm": "2022-02-22 17:23:44",
    "vehicle_code" => "ZIDAN"
}
```

### **Reply**

```
{
    "dttm": "2022-02-27 16:50:42",
    "log": {
        "dttm": "2022-02-27 16:40:41",
        "vehicle_code": "ZIDAN",
        "mileage": "0",
        "battery_capacity": "0",
        "gps": "50.9128308N, 14.6171558E"
    },
    "status_key": 11,
    "status_mess": "Log found",
    "signature": "211dbd8a5e44ae3a069d13924f3b844f455574cb"
}
```

---

## STATUS CODES

```
 0 'OK'
 1 'Communication failure'
 2 'Bad operation'
 3 'Class not found'
 4 'Incomplete input data'
 5 'Cannot connect to database'
 6 'Vehicle not found in database'
 7 'Cannot insert log to database'
 8 'No log'
 9 'Bad signature'
10 'Log saved'
11 'Log found'
```

---

## SIGNATURE EXAMPLE

### **Input data**

```
{
    "dttm": "2022-02-20 13:45:50",
    "vehicle_code": "ZIDAN"
}
```

### **Signature**

We create the signature by taking the input values as a string, which is separated by a pipe character. At the end of the string is a secret.

```
signature = sha1("2022-02-20 13:45:50|ZIDAN|this-is-secret")
```

---

## LICENSE

MIT
