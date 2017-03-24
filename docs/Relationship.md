# User

- A user has many Services
- A user belong to a Group
- A user has many UserChangeLogs

# Service

- A service has many TrafficLogs
- A service belong to a Group
- A service belong to a User

# Group

- A group has many Users
- A group has many Nodes

# Node

- A node belong to a Group
- A node has many Services
- A node has many NodeStatusLogs

# UserChangeLog

- A userchangelog belong to a User

# TrafficLog

- A trafficlog belong to a Service

# NodeStatusLog

- A nodestatuslog belong to a node
