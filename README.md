# Shopping Cart

A simple shopping cart written in PHP with basic features. The focus of this project was to learn how to handle object serialization, unit testing and to practice object-oriented programming.

## Features

- **Logging:** you can easily track the status of the entire application.
- **Database integration:** you can retrieve data from your database and map to Product objects with [SqlRepository](src/database/repository/SqlRepository.php) abstract class and [ProductBuilder](src/cart/builder/ProductBuilder.php) class.
- **Object serialization:** you can save the current state of the cart as well as the item or product in a json or in a binary file.
- **Value objects:** it is easy to adapt the module to your business model.

## Future Features

- **Checkout integration:** I also plan to add support for payment services.

## Composer Commands

- **composer run tests:** Run all the tests in test directory.

**Project Status:** In Development
