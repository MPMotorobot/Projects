# Portfolio projects

This site uses PHP, MySQL or MariaDB, and vanilla JavaScript. In XAMPP, start Apache and MySQL, then import `projects.sql` to create and seed the portfolio database.

The homepage API reads `PROJECTS_DB_HOST`, `PROJECTS_DB_USER`, `PROJECTS_DB_PASSWORD`, and `PROJECTS_DB_NAME` from the PHP environment. Without these variables it uses the default local XAMPP connection (`localhost`, `root`, empty password, database `projects`). For a shared server, configure a database account with read-only access to `projects.projects`.

The example projects have their own databases. Import the matching `zadania/zN/BD/baza.sql` file before opening a PHP project that uses one. The `z10` results page also requires the `LAB_ADMIN_USER` and `LAB_ADMIN_PASSWORD_HASH` variables described in `zadania/z10/README.md`.
