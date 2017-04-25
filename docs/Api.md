# API概述

## 通用约定
**基本地址为 `/server/{token}/`**
- `token`为随机字符串，本文档后面所提到的`基本地址`均指代此路径
- 全部`GET/POST`均使用`JSON`作为封装规范(除非另有说明)，`UTF-8`作为编码格式
- 每一个节点的`token`均不一样，当节点服务器出现异常方便快速定位
- **强烈建议使用`HTTPS`**
- 状态码说明：
一般返回的请求头里面会有对应的状态，但是正常情况(`Status : 200`)会在返回的数据中包含，以方便直接排除/过滤非正常情况（即最小化处理，只受理成功的回复，无法解析的直接丢弃）
 - 404 找不到对应地址，通常是基本地址中`token`错误
 - 500 服务器内部错误
 - 200 成功处理
 - 400 部分处理成功

## Shadowsocks 相关服务
文档顺序按照程序执行顺序

### 通用约定
Shadowsocks 服务需要在`基本地址`的基础上增加`shadowsocks/`

### 首次启动

#### `GET user` _(必要 Core)_
返回将会按照如下格式：
```
{
    "status": 200,
    "timestamp": 1492444348,
    "interval": 1,
    "data": [
      {
        "service_id": 1001,
        "port": 10001,
        "traffic": 2302030403,
        "method": "aes-256-cfb",
        "enable": true
      },

      {
      ...
      }
    ]
}
```
- `status` 状态码，默认`200`
- `timestamp` Unix单位制，当前时间，`int`
- `interval` 上传间隔时间，单位分钟，`int`
- `Data` 包含的Shadowsocks服务数据
  - `service_id` 服务序列号，`int`
  - `port` 服务端口号，`int`
  - `traffic` 流量，按字节计算，`bigint`
  - `method` 加密方式，`string`
  - `enable` 是否启用，`boolean`

#### `Get blacklist` _(建议 Recommended)_
`blacklist` 不允许访问的地址/使用的协议，具体格式请参阅`其他/可选业务说明`获得详情
**需要在启动时获取**

### 正常业务流程

#### `POST traffic` _(必要 Core)_
提交数据格式如下：
```
{
    "timestamp": 1492444348,
    "data": [
      {
        "service_id": 1001,
        "upload" : 2302,
        "download": 3203,
        "source_ip": [
          "127.0.0.1",
          ...
        ]
      },

      {
      ...
      },
   ]
}
```
- `timestamp` Unix单位制，当前时间，`int`
- `Data` 上报的Shadowsocks服务数据
  - `service_id` 服务序列号，`int`
  - `upload` 上传流量，按字节计算，`bigint`
  - `download` 下载流量，按字节计算，`bigint`
  - `source_ip` 使用者IP，包含一个或多个IP地址，`JSON`封装一个数组

**正常返回数据格式如下：**
```
{
    "status": 200,
    "timestamp": 1492444348,
    "command": '',
    "data":[
      {
        "service_id": 1001,
        "port": 10001,
        "traffic": 2302030403,
        "method": "aes-256-cfb",
        "enable": true
      },

      {
      ...
      }
    ]
}
```
- `status` 状态码，如果并非`200`则认定此次上传不成功。获取到400则仅收集更新失败用户的流量信息并立即尝试重新上传。  
- `timestamp` Unix单位制，当前时间，`int`
- `command` `服务器指令`，请移步`其他/可选业务说明`获取详情 _(可选 Optional)_
- `interval` 上传间隔时间，单位分钟，`int`  
- `Data` 包含的Shadowsocks服务数据  
  - `service_id` 服务序列号，`int`
  - `port` 服务端口号，`int`
  - `traffic` 流量，按字节计算，`bigint`
  - `method` 加密方式，`string`
  - `enable` 是否启用，`boolean`
  
**更新失败返回数据格式如下：**
_注意，此处状态码为400_
```
{
    "status": 400,
    "timestamp": 1492507393,
    "updated_users": [
        1001,
        1004,
        ...
    ]
}
```
- `status` 状态码
- `timestamp` Unix单位制，当前时间，`int`
- `updated_users` 一个数组，包含更新成功的用户`服务序列号`

### 错误反馈

- 通常来说，所有`Error`以上的错误都应该默认被反馈。（但是如果超出可控范围，例如进程和守护进程均被杀死，可能并不会返回）
- 反馈默认是以触发反馈的日志算起的前`100`条。

#### `POST error`_(建议 Recommended)_
提交数据格式如下：
```
{
    "timestamp": 1492444348,
    "type": "Error"
    "exit": false
    "data": [
        "...",
        "Error: Port 10001: Failed to listen the port"
    ]
}
```
- `timestamp` Unix单位制，当前时间，`int`
- `type` 错误等级，`string`
- `exit` 是否退出，`false`意味着服务仍可继续运行，`boolean`
- `Data` 错误日志，`text`

返回的数据格式如下
```
{
    "status": 200,
    "timestamp": 1492444348,
    "command" : '',
}
```
- `status` 状态码，如果并非`200`则认定此次上传不成功 (将日志保存在本地并以当前时间戳命名，可选）
- `timestamp` Unix单位制，当前时间，`int`
- `command` `服务器指令`，请移步`其他/可选业务说明`获取详情


### 其他/可选业务说明

#### `blacklist 不允许访问的地址/使用的协议` _(建议 Recommended)_
以`JSON`封装，格式如下：
```
{
    "web": [
      "/(360.cn)/",
      "/116.76.1.1/"
      ...
    ]
    "port": [
      25,
      ...
    ]
}
```
- `web` 部分包含一个或多个网页/IP，`string`,正则表达
- `port` 部分包含一个或多个端口，`int`

#### `Command/服务器指令` 字段 _(可选 Optional)_
在遭受攻击需要临时关闭服务，或者强制刷新`基础信息`时会返回的指令，**通常情况下该项为空**  
包含以下指令：
  - `shutdown` 暂时关闭服务
    - `{minute}` 分钟,**必填** `int`  
    例子：`shutdown 30` 暂停服务30分钟
  - `refresh` 上传当前本地储存的数据并立即重抓取数据(即从`首次启动`重新载入业务)
  - `blacklist`
  - `log` 向`error`返回日志
    - `{number}` 返回的日志数,**必填**，`int`  
    例子：`log 300` 返回最近的300条日志  
    

**如果Command包含了无法解读的命令则记录进错误日志(等级`Error`)并尝试提交**

## AnyConnect 服务
文档顺序按照程序执行顺序

### 通用约定
`AnyConnect` 服务需要在`基本地址`的基础上增加`anyconnect/`

### 首次启动

#### `GET user` _(必要 Core)_

返回将会按照`Openconnect`要求

@TODO AnyConnect 暂时只保证可用
