dollarhttp
==========

DollarHttp will be a full-spectrum request cURL wrapper for PHP.

DollarHttp is intended to create a clean, easy way to interact with cURL and make calls across both HTTP and HTTPS
via the four most common methods:

- DELETE
- GET
- POST
- PUT

DollarHttp will support custom headers, POST and PUT body contents and a clear, method agnostic API for managing
request arguments.

DollarHttp takes the philosophical stance that an HTTP request abstraction should be:

Clear
Well defined
Easy to use
Easy to mock
Powerful

Though cURL is powerful, it lacks clarity and ease of use.  Mocking cURL is non-trivial which makes logic around
programmatic HTTP requests difficult to test.  DollarHttp aims to make a clear, clean, injectable, mockable,
well-tested solution suitable for use without being tied to any other framework or library to accomplish the task.

Completed items are as follows:

- [X] Object creation (accepted arguments: URL, request method, arguments, body)
- [X] URL management
- [X] Method management (get, set and clear -- defaults to GET on clear)
- [X] Argument management (get, set, delete, clear)
- [X] Custom header management (get, set, delete and clear)
- [X] Request body management (get, set and clear)
- [X] Argument construction upon executing request
- [X] Header construction upon executing request
- [ ] HTTP and HTTPS support
- [ ] Full API documentation


