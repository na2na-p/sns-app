```mermaid
erDiagram

  User {
    String id PK 
    String name  
    String email  
    String password  
    }
  

  Message {
    String id PK 
    DateTime created_at  
    String body  
    }
  
    Message o{--|o User : "User"
```
