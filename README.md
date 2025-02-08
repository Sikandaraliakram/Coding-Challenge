Coding Challenge
======================

Overview
--------

This project is a simple web application designed to help a small bookshop owner analyze sales data efficiently. It processes a given JSON export of sales, stores the data in a database, and provides a web interface with filtering options.

Features
--------

*   **Database Design:** Optimized schema for storing sales data.

*   **Data Processing:** Reads JSON data and saves it into a database using PHP.

*   **Filtering Options:** Customers can filter sales by:

    *   Customer name

    *   Product (book title)

    *   Price range

*   **Sales Report:** Displays filtered results in a table.

*   **Total Calculation:** Shows the total price for all filtered sales.

*   **Timezone Handling:** Adjusts sales dates based on the shop system’s version:

    *   Before version 1.0.17+60: Europe/Berlin timezone

    *   After version 1.0.17+60: UTC timezone

*   **Version Comparison Class:** Provides a tested class to handle version checks.


Technologies Used
-----------------

*   **PHP** (with Composer)

*   **MySQL**

*   **Routes** for navigation

*   **Twig** (templating engine)

*   **jQuery** (for AJAX requests)


Setup & Execution
-----------------

1.  Start your Apache server (**WAMP, MAMP, or XAMPP**).

2.  http://localhost/Coding-challenge


Notes
-----

*   The project uses **Composer** for dependency management.

*   **AJAX** is used for dynamic filtering without reloading the page.

*   The system ensures efficient data storage and retrieval for performance optimization.
