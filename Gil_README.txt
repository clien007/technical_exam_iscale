### Bad Practice ###

## Singleton Pattern Misuse
Bad Practice:
 
private static $instance = null;
private function __construct() { ... }
public static function getInstance() { ... }

Explanation:
    Global State: The Singleton pattern creates a global instance that can lead to hidden dependencies between components, making the system harder to test and maintain.
    Tight Coupling: Singleton instances are tightly coupled to the global state, making it challenging to manage multiple instances or mock them in tests.
    Constructor Visibility: The private constructor is often used to enforce the Singleton pattern, but it can make dependency injection and testing more difficult.

## Direct SQL Queries with String Concatenation
$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
$db->exec($sql);

Explanation:
    SQL Injection: Directly concatenating user inputs into SQL queries is vulnerable to SQL injection attacks. Prepared statements should be used to prevent this.
    Security: Using prepared statements with bound parameters is a safer practice that ensures user inputs are properly escaped and sanitized.

## Lack of Input Validation and Sanitization
public function addCommentForNews($body, $newsId) { ... }
public function addNews($title, $body) { ... }

Explanation:
    Security Risks: The code does not validate or sanitize inputs, which can lead to security vulnerabilities such as SQL injection, XSS (Cross-Site Scripting), and data corruption.
    Data Integrity: Without validation, invalid or unexpected data might be inserted into the database, affecting data integrity.

## Static Method Calls for Singleton Instances
CommentManager::getInstance()->listComments();
NewsManager::getInstance()->listNews();

Explanation:
    Global State: Relying on static methods for singletons introduces a global state, which makes code harder to test and maintain.
    Dependency Management: It becomes challenging to manage dependencies and mock objects when using static methods for singleton instances.



#### IMPROVEMENTS ###

## Factory Design Pattern: 
    The FactoryInterface defines a contract for creating objects. The CommentFactory and NewsFactory classes implement this interface, each responsible for creating an instance of Comment and News, respectively.

## Repository Design Pattern
    Which handles the database queries
    The purpose of a repository is to provide a centralized and abstracted layer for managing data access and persistence operations, allowing the rest of the application to interact with the data source through a simplified and consistent API.

## SOLID Principles:
    SRP: Each class has a single responsibility.
    OCP: The classes are open for extension but closed for modification. We can extend Comment and News if necessary without modifying the base class.
    LSP: Although we don't use inheritance here, our classes are designed so that if we did, any derived class could replace the base class without breaking the code.
    ISP: We're using specific interfaces (FactoryInterface).
    DIP: The CommentFactory and NewsFactory depend on an abstraction (FactoryInterface) rather than a concrete class.

## Use of Namespaces: 
    Ensure the code is properly namespaced.

## Dependency Injection: 
    Inject dependencies where needed.

## Proper File Organization: 
    Ensure that files are organized properly and included as needed.

## Error Handling: 
    Handle potential errors gracefully.

## Sanitization and Validation
    Title Validation (News):
        Ensures that the title is not empty and does not exceed 255 characters. This is important to prevent empty titles and overly long titles that could break the UI or cause other issues.
    
    Body Validation (News & Comment): 
        Ensures that the body is not empty. This is crucial to ensure that all news items have meaningful content.
    
    News ID Validation: 
        The newsIdExists method queries the news table to check if the newsId exists. It returns a boolean value indicating whether the newsId is valid or not.
        If newsId does not exist, an InvalidArgumentException is thrown, indicating the error.
    
    Exception Handling:
    Throws \InvalidArgumentException if the validation fails. This provides clear feedback about what went wrong, which can be useful for debugging and improving user experience.
    Sanitization:

    The htmlspecialchars function is used to convert special characters to HTML entities, which helps prevent XSS attacks by escaping potentially harmful characters.
    Parameterized Queries:

    Uses parameterized queries to prevent SQL injection, ensuring that user inputs are safely handled.
