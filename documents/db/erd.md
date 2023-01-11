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
    String body  
    DateTime created_at  
    }
  
    Message o{--|o User : "User"
```
