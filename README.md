## Bad Practice ##

  ### Singleton Pattern Misuse
      private static $instance = null;
      private function __construct() { ... }
      public static function getInstance() { ... }

  Explanation:<br>
    Global State: The Singleton pattern creates a global instance that can lead to hidden dependencies between components, making the system harder to test and maintain.<br>
    Tight Coupling: Singleton instances are tightly coupled to the global state, making it challenging to manage multiple instances or mock them in tests.<br>
    Constructor Visibility: The private constructor is often used to enforce the Singleton pattern, but it can make dependency injection and testing more difficult.

  ### Direct SQL Queries with String Concatenation
      $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
      $db->exec($sql);

  Explanation:<br>
    SQL Injection: Directly concatenating user inputs into SQL queries is vulnerable to SQL injection attacks. Prepared statements should be used to prevent this.<br>
    Security: Using prepared statements with bound parameters is a safer practice that ensures user inputs are properly escaped and sanitized.

  ### Lack of Input Validation and Sanitization
      public function addCommentForNews($body, $newsId) { ... }
      public function addNews($title, $body) { ... }

  Explanation:<br>
    Security Risks: The code does not validate or sanitize inputs, which can lead to security vulnerabilities such as SQL injection, XSS (Cross-Site Scripting), and data corruption.<br>
    Data Integrity: Without validation, invalid or unexpected data might be inserted into the database, affecting data integrity.

  ### Static Method Calls for Singleton Instances
      CommentManager::getInstance()->listComments();
      NewsManager::getInstance()->listNews();

  Explanation:<br>
    Global State: Relying on static methods for singletons introduces a global state, which makes code harder to test and maintain.<br>
    Dependency Management: It becomes challenging to manage dependencies and mock objects when using static methods for singleton instances.

  ### Using Class Folder Name
  Class: The term "Class" is too generic and doesn't provide context about what the folder contains. <br>
  Everything in object-oriented programming is technically a class, so using "Class" as a folder name doesn't convey meaningful information about its purpose.


## IMPROVEMENTS ##

### Factory Design Pattern: 
  The FactoryInterface defines a contract for creating objects. The CommentFactory and NewsFactory classes implement this interface, each responsible for creating an instance of Comment and News, respectively.

### Repository Design Pattern
  Which handles the database queries<br>
  The purpose of a repository is to provide a centralized and abstracted layer for managing data access and persistence operations, allowing the rest of the application to interact with the data source through a simplified and consistent API.

### SOLID Principles:
  SRP: Each class has a single responsibility.<br>
  OCP: The classes are open for extension but closed for modification. We can extend Comment and News if necessary without modifying the base class.<br>
  LSP: Although we don't use inheritance here, our classes are designed so that if we did, any derived class could replace the base class without breaking the code.<br>
  ISP: We're using specific interfaces (FactoryInterface).<br>
  DIP: The CommentFactory and NewsFactory depend on an abstraction (FactoryInterface) rather than a concrete class.

### Implement autoload
  This reduces the amount of boilerplate code you need to write and maintain.<br>
  If you ever move or rename a class file, the autoloader will handle the change seamlessly as long as you follow consistent naming conventions.

### Use of Namespaces: 
  Ensure the code is properly namespaced.

### Dependency Injection: 
  Inject dependencies where needed.

### Proper File Organization: 
  Ensure that files are organized properly and included as needed.

### Error Handling: 
  Handle potential errors gracefully.

### Sanitization and Validation
  Title Validation (News):<br>
    Ensures that the title is not empty and does not exceed 255 characters. This is important to prevent empty titles and overly long titles that could break the UI or cause other issues.<br>

  Body Validation (News & Comment): <br>
    Ensures that the body is not empty. This is crucial to ensure that all news items have meaningful content.<br>
 
  News ID Validation:<br>
    The newsIdExists method queries the news table to check if the newsId exists. It returns a boolean value indicating whether the newsId is valid or not.<br>
    If newsId does not exist, an InvalidArgumentException is thrown, indicating the error.<br>
 
  Exception Handling:<br>
      Throws \InvalidArgumentException if the validation fails. This provides clear feedback about what went wrong, which can be useful for debugging and improving user experience.<br>

  Sanitization:<br>
    The htmlspecialchars function is used to convert special characters to HTML entities, which helps prevent XSS attacks by escaping potentially harmful characters.<br>

  Parameterized Queries:<br>
    Uses parameterized queries to prevent SQL injection, ensuring that user inputs are safely handled.<br>
