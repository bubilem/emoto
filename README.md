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
    "message" => "Hello"
}
```

### **Reply**

```
{
    "dttm": "2022-02-20 13:45:50",
    "message" => "Hello"
}
```

---

## ADD LOG

Add log to store

### **Request**

URL:

```
{server_url}/add-log
```

POST:

```
{
    "dttm": "2022-02-20 13:45:50",
    "vehicle_code": "MB42",
    "mileage": "5",
    "battery_capacity": "48"
}
```

### **Reply**

```
{
    "message": "Log saved",
    "dttm":"2022-02-20 13:45:51",
    "status_key": 0,
    "status_mess": "OK"
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
    "vehicle_code" => "MB42"
}
```

### **Reply**

```
{
    "log": {
        "dttm": "2022-02-22 18:20:54",
        "vehicle_code": "MB42",
        "mileage": "5",
        "battery_capacity": "48.00"
        },
    "dttm": "2022-02-22 17:23:44",
    "status_key": 0,
    "status_mess": "OK"
}
```
