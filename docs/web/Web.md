# 概述

JSON包装，状态码总是200，
可以的话请加上头："Accept":"application/json"
## 总是存在的变量
- (header)Http 状态码 默认200正常
- (JSON)status 状态信息

## 获取概述

除了GET以外的方法都是要验证CSRF验证，字串`_TOKEN`

## 错误码
- 422 状态异常,需要用户介入并允许进一步重试。通常是认证错误i
